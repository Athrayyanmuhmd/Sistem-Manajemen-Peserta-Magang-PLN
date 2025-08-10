<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use App\Models\Department;
use App\Models\University;
use App\Models\Division;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use App\Http\Resources\InternResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class InternController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of interns with filtering and search.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Intern::with(['department', 'university', 'division']);

            // Search functionality
            if ($search = $request->get('search')) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('student_id', 'like', "%{$search}%")
                      ->orWhere('major', 'like', "%{$search}%")
                      ->orWhereHas('university', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('department', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('division', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
                });
            }

            // Filters
            if ($status = $request->get('status')) {
                $query->where('status', $status);
            }

            if ($department = $request->get('department_id')) {
                $query->where('department_id', $department);
            }

            if ($university = $request->get('university_id')) {
                $query->where('university_id', $university);
            }

            if ($division = $request->get('division_id')) {
                $query->where('division_id', $division);
            }

            // Sorting
            $sortField = $request->get('sort', 'created_at');
            $sortDirection = $request->get('direction', 'desc');
            
            $allowedSorts = ['name', 'email', 'start_date', 'end_date', 'status', 'created_at'];
            if (in_array($sortField, $allowedSorts)) {
                $query->orderBy($sortField, $sortDirection);
            }

            $perPage = min($request->get('per_page', 15), 100);
            $interns = $query->paginate($perPage);

            return $this->success(
                InternResource::collection($interns)->additional([
                    'meta' => [
                        'total_count' => $interns->total(),
                        'per_page' => $interns->perPage(),
                        'current_page' => $interns->currentPage(),
                        'last_page' => $interns->lastPage(),
                    ]
                ]),
                'Data peserta magang berhasil diambil'
            );

        } catch (Exception $e) {
            Log::error('Error in Api/InternController@index: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return $this->serverError('Terjadi kesalahan saat mengambil data peserta magang');
        }
    }

    /**
     * Store a newly created intern in storage.
     */
    public function store(StoreInternRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            
            // Check department capacity
            $department = Department::findOrFail($validated['department_id']);
            if (!$department->canAcceptMoreInterns()) {
                return $this->error(
                    "Departemen {$department->name} sudah mencapai kapasitas maksimum",
                    400
                );
            }
            
            // Check division capacity
            $division = Division::findOrFail($validated['division_id']);
            if (!$division->canAcceptMoreInterns()) {
                return $this->error(
                    "Divisi {$division->name} sudah mencapai kapasitas maksimum",
                    400
                );
            }
            
            // Handle photo upload if exists
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('intern-photos', 'public');
                $validated['photo'] = $photoPath;
            }

            // Create the intern
            $intern = Intern::create($validated);
            $intern->load(['department', 'university', 'division']);
            
            DB::commit();
            
            Log::info('New intern created successfully via API', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'email' => $intern->email,
                'created_by' => auth()->id()
            ]);

            return $this->created(
                new InternResource($intern),
                "Peserta magang {$intern->name} berhasil ditambahkan"
            );
                
        } catch (Exception $e) {
            DB::rollBack();
            
            // Remove uploaded photo if exists
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            Log::error('Error in Api/InternController@store: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return $this->serverError('Terjadi kesalahan saat menyimpan data peserta magang');
        }
    }

    /**
     * Display the specified intern.
     */
    public function show(Intern $intern): JsonResponse
    {
        try {
            $intern->load(['department', 'university', 'division']);
            
            // Update real-time progress
            $intern->updateProgressAutomatically();
            
            return $this->resource(
                new InternResource($intern),
                'Detail peserta magang berhasil diambil'
            );
            
        } catch (Exception $e) {
            Log::error('Error in Api/InternController@show: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id
            ]);

            return $this->serverError('Terjadi kesalahan saat mengambil detail peserta magang');
        }
    }

    /**
     * Update the specified intern in storage.
     */
    public function update(UpdateInternRequest $request, Intern $intern): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            $oldPhotoPath = $intern->photo;
            
            // Check capacity if department or division changed
            if ($intern->department_id != $validated['department_id']) {
                $newDepartment = Department::findOrFail($validated['department_id']);
                if (!$newDepartment->canAcceptMoreInterns()) {
                    return $this->error(
                        "Departemen {$newDepartment->name} sudah mencapai kapasitas maksimum",
                        400
                    );
                }
            }
            
            if ($intern->division_id != $validated['division_id']) {
                $newDivision = Division::findOrFail($validated['division_id']);
                if (!$newDivision->canAcceptMoreInterns()) {
                    return $this->error(
                        "Divisi {$newDivision->name} sudah mencapai kapasitas maksimum",
                        400
                    );
                }
            }
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('intern-photos', 'public');
                $validated['photo'] = $photoPath;
                
                // Delete old photo
                if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }

            // Update the intern
            $intern->update($validated);
            $intern->load(['department', 'university', 'division']);
            
            DB::commit();
            
            Log::info('Intern updated successfully via API', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'updated_by' => auth()->id(),
                'changes' => $intern->getChanges()
            ]);

            return $this->updated(
                new InternResource($intern),
                "Data peserta magang {$intern->name} berhasil diperbarui"
            );
                
        } catch (Exception $e) {
            DB::rollBack();
            
            // Remove uploaded photo if exists
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            Log::error('Error in Api/InternController@update: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id,
                'request' => $request->all()
            ]);

            return $this->serverError('Terjadi kesalahan saat memperbarui data peserta magang');
        }
    }

    /**
     * Remove the specified intern from storage.
     */
    public function destroy(Intern $intern): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $internName = $intern->name;
            
            // Soft delete the intern
            $intern->delete();
            
            DB::commit();
            
            Log::info('Intern soft deleted successfully via API', [
                'intern_id' => $intern->id,
                'name' => $internName,
                'deleted_by' => auth()->id()
            ]);

            return $this->deleted("Peserta magang {$internName} berhasil dihapus");
                
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error in Api/InternController@destroy: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id
            ]);

            return $this->serverError('Terjadi kesalahan saat menghapus data peserta magang');
        }
    }

    /**
     * Restore a soft deleted intern.
     */
    public function restore($id): JsonResponse
    {
        try {
            $intern = Intern::withTrashed()->findOrFail($id);
            $intern->restore();
            $intern->load(['department', 'university', 'division']);
            
            Log::info('Intern restored successfully via API', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'restored_by' => auth()->id()
            ]);

            return $this->success(
                new InternResource($intern),
                "Peserta magang {$intern->name} berhasil dipulihkan"
            );
                
        } catch (Exception $e) {
            Log::error('Error in Api/InternController@restore: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $id
            ]);

            return $this->serverError('Terjadi kesalahan saat memulihkan data peserta magang');
        }
    }

    /**
     * Get intern statistics.
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total_interns' => Intern::count(),
                'active_interns' => Intern::active()->count(),
                'pending_interns' => Intern::pending()->count(),
                'completed_interns' => Intern::completed()->count(),
                'terminated_interns' => Intern::terminated()->count(),
                'by_department' => Department::withCount(['interns' => function($query) {
                    $query->active();
                }])->get()->pluck('interns_count', 'name'),
                'by_university' => University::withCount(['interns' => function($query) {
                    $query->active();
                }])->get()->pluck('interns_count', 'name'),
                'by_status' => Intern::select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->pluck('count', 'status'),
            ];

            return $this->success($stats, 'Statistik peserta magang berhasil diambil');
            
        } catch (Exception $e) {
            Log::error('Error in Api/InternController@statistics: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return $this->serverError('Terjadi kesalahan saat mengambil statistik');
        }
    }
}