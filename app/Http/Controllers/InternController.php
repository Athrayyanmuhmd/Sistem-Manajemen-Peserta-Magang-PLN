<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use App\Models\Department;
use App\Models\University;
use App\Models\Division;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Throwable;

class InternController extends Controller
{

    /**
     * Display a listing of interns with filtering and search.
     */
    public function index(Request $request): View
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

            // Filter by status
            if ($status = $request->get('status')) {
                $query->where('status', $status);
            }

            // Filter by department
            if ($department = $request->get('department_id')) {
                $query->where('department_id', $department);
            }

            // Filter by university
            if ($university = $request->get('university_id')) {
                $query->where('university_id', $university);
            }

            // Filter by division
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

            $perPage = min($request->get('per_page', 15), 100); // Max 100 per page
            $interns = $query->paginate($perPage)->withQueryString();

            // Data for filters
            $departments = Department::active()->orderBy('name')->get();
            $universities = University::active()->orderBy('name')->get();
            $divisions = Division::active()->orderBy('name')->get();
            $statuses = Intern::STATUSES;

            return view('interns.index', compact(
                'interns', 'departments', 'universities', 'divisions', 'statuses'
            ));

        } catch (Exception $e) {
            Log::error('Error in InternController@index: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return view('interns.index')->with('error', 'Terjadi kesalahan saat memuat data peserta magang.');
        }
    }

    /**
     * Show the form for creating a new intern.
     */
    public function create(): View
    {
        try {
            $departments = Department::active()->withCapacity()->orderBy('name')->get();
            $universities = University::active()->orderBy('name')->get();
            $divisions = Division::active()->withCapacity()->orderBy('name')->get();
            
            return view('interns.create', compact('departments', 'universities', 'divisions'));
            
        } catch (Exception $e) {
            Log::error('Error in InternController@create: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat memuat form tambah peserta.');
        }
    }

    /**
     * Store a newly created intern in storage.
     */
    public function store(StoreInternRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            
            // Check department capacity
            $department = Department::findOrFail($validated['department_id']);
            if (!$department->canAcceptMoreInterns()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Departemen {$department->name} sudah mencapai kapasitas maksimum.");
            }
            
            // Check division capacity
            $division = Division::findOrFail($validated['division_id']);
            if (!$division->canAcceptMoreInterns()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Divisi {$division->name} sudah mencapai kapasitas maksimum.");
            }
            
            // Handle photo upload if exists
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('intern-photos', 'public');
                $validated['photo'] = $photoPath;
            }

            // Create the intern
            $intern = Intern::create($validated);
            
            DB::commit();
            
            Log::info('New intern created successfully', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'email' => $intern->email,
                'created_by' => auth()->id()
            ]);

            return redirect()->route('interns.index')
                ->with('success', "Peserta magang {$intern->name} berhasil ditambahkan.");
                
        } catch (Exception $e) {
            DB::rollBack();
            
            // Remove uploaded photo if exists
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            Log::error('Error in InternController@store: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data peserta magang. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified intern.
     */
    public function show(Intern $intern): View
    {
        try {
            $intern->load(['department', 'university', 'division']);
            
            // Update real-time progress
            $intern->updateProgressAutomatically();
            
            // Get progress status
            $progressStatus = $intern->progress_status;
            
            return view('interns.show', compact('intern', 'progressStatus'));
            
        } catch (Exception $e) {
            Log::error('Error in InternController@show: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat memuat detail peserta magang.');
        }
    }

    /**
     * Show the form for editing the specified intern.
     */
    public function edit(Intern $intern): View
    {
        try {
            $departments = Department::active()->orderBy('name')->get();
            $universities = University::active()->orderBy('name')->get();
            $divisions = Division::active()->orderBy('name')->get();
            $statuses = Intern::STATUSES;
            
            return view('interns.edit', compact('intern', 'departments', 'universities', 'divisions', 'statuses'));
            
        } catch (Exception $e) {
            Log::error('Error in InternController@edit: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat memuat form edit peserta.');
        }
    }

    /**
     * Update the specified intern in storage.
     */
    public function update(UpdateInternRequest $request, Intern $intern): RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            $oldPhotoPath = $intern->photo;
            
            // Check capacity if department or division changed
            if ($intern->department_id != $validated['department_id']) {
                $newDepartment = Department::findOrFail($validated['department_id']);
                if (!$newDepartment->canAcceptMoreInterns()) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Departemen {$newDepartment->name} sudah mencapai kapasitas maksimum.");
                }
            }
            
            if ($intern->division_id != $validated['division_id']) {
                $newDivision = Division::findOrFail($validated['division_id']);
                if (!$newDivision->canAcceptMoreInterns()) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Divisi {$newDivision->name} sudah mencapai kapasitas maksimum.");
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
            
            DB::commit();
            
            Log::info('Intern updated successfully', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'updated_by' => auth()->id(),
                'changes' => $intern->getChanges()
            ]);
            
            return redirect()->route('interns.index')
                ->with('success', "Data peserta magang {$intern->name} berhasil diperbarui.");
                
        } catch (Exception $e) {
            DB::rollBack();
            
            // Remove uploaded photo if exists
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            Log::error('Error in InternController@update: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id,
                'request' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data peserta magang.');
        }
    }

    /**
     * Remove the specified intern from storage (soft delete).
     */
    public function destroy(Intern $intern): RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            $internName = $intern->name;
            $photoPath = $intern->photo;
            
            // Soft delete the intern
            $intern->delete();
            
            // Optionally keep the photo for audit purposes
            // If you want to delete the photo immediately, uncomment below:
            // if ($photoPath && Storage::disk('public')->exists($photoPath)) {
            //     Storage::disk('public')->delete($photoPath);
            // }
            
            DB::commit();
            
            Log::info('Intern soft deleted successfully', [
                'intern_id' => $intern->id,
                'name' => $internName,
                'deleted_by' => auth()->id()
            ]);

            return redirect()->route('interns.index')
                ->with('success', "Peserta magang {$internName} berhasil dihapus.");
                
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error in InternController@destroy: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $intern->id
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data peserta magang.');
        }
    }

    /**
     * Restore a soft deleted intern.
     */
    public function restore($id): RedirectResponse
    {
        try {
            $intern = Intern::withTrashed()->findOrFail($id);
            $intern->restore();
            
            Log::info('Intern restored successfully', [
                'intern_id' => $intern->id,
                'name' => $intern->name,
                'restored_by' => auth()->id()
            ]);

            return redirect()->route('interns.index')
                ->with('success', "Peserta magang {$intern->name} berhasil dipulihkan.");
                
        } catch (Exception $e) {
            Log::error('Error in InternController@restore: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $id
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat memulihkan data peserta magang.');
        }
    }

    /**
     * Force delete an intern permanently.
     */
    public function forceDelete($id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            
            $intern = Intern::withTrashed()->findOrFail($id);
            $internName = $intern->name;
            $photoPath = $intern->photo;
            
            // Delete photo if exists
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            // Force delete
            $intern->forceDelete();
            
            DB::commit();
            
            Log::warning('Intern force deleted permanently', [
                'intern_id' => $id,
                'name' => $internName,
                'deleted_by' => auth()->id()
            ]);

            return redirect()->route('interns.index')
                ->with('success', "Peserta magang {$internName} berhasil dihapus permanen.");
                
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error in InternController@forceDelete: ' . $e->getMessage(), [
                'exception' => $e,
                'intern_id' => $id
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat menghapus permanen data peserta magang.');
        }
    }

    /**
     * Bulk operations for interns.
     */
    public function bulkAction(Request $request): RedirectResponse
    {
        $request->validate([
            'action' => 'required|in:delete,restore,force_delete,update_status',
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'integer|exists:interns,id',
            'status' => 'sometimes|in:' . implode(',', array_keys(Intern::STATUSES)),
        ]);

        try {
            DB::beginTransaction();
            
            $selectedIds = $request->selected_ids;
            $action = $request->action;
            $count = count($selectedIds);
            
            switch ($action) {
                case 'delete':
                    Intern::whereIn('id', $selectedIds)->delete();
                    $message = "{$count} peserta magang berhasil dihapus.";
                    break;
                    
                case 'restore':
                    Intern::withTrashed()->whereIn('id', $selectedIds)->restore();
                    $message = "{$count} peserta magang berhasil dipulihkan.";
                    break;
                    
                case 'force_delete':
                    $interns = Intern::withTrashed()->whereIn('id', $selectedIds)->get();
                    foreach ($interns as $intern) {
                        if ($intern->photo && Storage::disk('public')->exists($intern->photo)) {
                            Storage::disk('public')->delete($intern->photo);
                        }
                    }
                    Intern::withTrashed()->whereIn('id', $selectedIds)->forceDelete();
                    $message = "{$count} peserta magang berhasil dihapus permanen.";
                    break;
                    
                case 'update_status':
                    Intern::whereIn('id', $selectedIds)->update(['status' => $request->status]);
                    $statusName = Intern::STATUSES[$request->status];
                    $message = "Status {$count} peserta magang berhasil diubah menjadi {$statusName}.";
                    break;
                    
                default:
                    throw new Exception('Invalid bulk action');
            }
            
            DB::commit();
            
            Log::info('Bulk action performed successfully', [
                'action' => $action,
                'count' => $count,
                'ids' => $selectedIds,
                'performed_by' => auth()->id()
            ]);

            return redirect()->route('interns.index')->with('success', $message);
            
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error('Error in InternController@bulkAction: ' . $e->getMessage(), [
                'exception' => $e,
                'action' => $request->action,
                'ids' => $request->selected_ids
            ]);

            return redirect()->route('interns.index')
                ->with('error', 'Terjadi kesalahan saat melakukan aksi bulk.');
        }
    }

    /**
     * Export interns data to various formats.
     */
    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,excel,pdf',
            'filters' => 'sometimes|array'
        ]);

        try {
            $query = Intern::with(['department', 'university', 'division']);
            
            // Apply filters if provided
            if ($filters = $request->get('filters')) {
                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }
                if (isset($filters['department_id'])) {
                    $query->where('department_id', $filters['department_id']);
                }
                if (isset($filters['university_id'])) {
                    $query->where('university_id', $filters['university_id']);
                }
                if (isset($filters['division_id'])) {
                    $query->where('division_id', $filters['division_id']);
                }
            }
            
            $interns = $query->get();
            $format = $request->format;
            $filename = 'peserta_magang_' . now()->format('Y-m-d_H-i-s');
            
            // Here you would implement the actual export logic
            // For now, returning a JSON response
            return response()->json([
                'success' => true,
                'message' => "Export {$format} untuk {$interns->count()} peserta magang sedang diproses.",
                'download_url' => route('interns.download', ['file' => $filename . '.' . $format])
            ]);
            
        } catch (Exception $e) {
            Log::error('Error in InternController@export: ' . $e->getMessage(), [
                'exception' => $e,
                'format' => $request->format
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengekspor data.'
            ], 500);
        }
    }
}
