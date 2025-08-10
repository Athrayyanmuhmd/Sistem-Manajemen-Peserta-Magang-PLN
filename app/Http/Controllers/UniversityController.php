<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::withCount(['interns', 'activeInterns']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('rector', 'like', "%{$search}%");
            });
        }

        // Province filter
        if ($request->filled('province')) {
            $query->where('province', $request->get('province'));
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Partnership level filter (based on intern count)
        if ($request->filled('partnership')) {
            $partnership = $request->get('partnership');
            switch($partnership) {
                case 'high':
                    $query->having('interns_count', '>=', 10);
                    break;
                case 'medium':
                    $query->having('interns_count', '>=', 5)->having('interns_count', '<', 10);
                    break;
                case 'low':
                    $query->having('interns_count', '>', 0)->having('interns_count', '<', 5);
                    break;
                case 'none':
                    $query->having('interns_count', '=', 0);
                    break;
            }
        }

        // Sort functionality
        $sortBy = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        
        $allowedSorts = ['name', 'city', 'province', 'interns_count', 'active_interns_count'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->orderBy('name');
        }

        $universities = $query->paginate(12)->appends($request->query());

        // Get provinces for filter dropdown
        $provinces = University::distinct()->pluck('province')->sort();

        return view('universities.index', compact('universities', 'provinces'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'rector' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
        ]);

        University::create($validated);

        return redirect()->route('universities.index')
            ->with('success', 'Universitas berhasil ditambahkan.');
    }

    public function show(University $university)
    {
        $university->loadCount(['interns', 'activeInterns']);
        $university->load(['interns' => function($query) {
            $query->with(['division', 'department'])->latest()->take(10);
        }]);

        // Get university statistics
        $stats = [
            'total_interns' => $university->interns_count,
            'active_interns' => $university->active_interns_count,
            'completion_rate' => $university->interns->where('status', 'completed')->count(),
            'avg_satisfaction' => $university->interns->whereNotNull('satisfaction_score')->avg('satisfaction_score'),
            'avg_completion' => $university->interns->whereNotNull('completion_percentage')->avg('completion_percentage'),
            'top_majors' => $university->interns->groupBy('major')->map(function($group) {
                return $group->count();
            })->sortDesc()->take(5),
        ];

        return view('universities.show', compact('university', 'stats'));
    }

    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'rector' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
        ]);

        $university->update($validated);

        return redirect()->route('universities.show', $university)
            ->with('success', 'Data universitas berhasil diperbarui.');
    }

    public function destroy(University $university)
    {
        if ($university->interns()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus universitas yang masih memiliki peserta magang.');
        }

        $university->delete();

        return redirect()->route('universities.index')
            ->with('success', 'Universitas berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = University::withCount(['interns', 'activeInterns']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('rector', 'like', "%{$search}%");
            });
        }

        if ($request->filled('province')) {
            $query->where('province', $request->get('province'));
        }

        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $universities = $query->orderBy('name')->get();

        $csv = "Nama Lengkap,Nama Singkat,Kota,Provinsi,Rektor,Total Peserta,Peserta Aktif,Tingkat Kemitraan,Status,Website,Email,Telepon,Alamat\n";
        
        foreach ($universities as $university) {
            $partnershipLevel = '';
            if ($university->interns_count >= 10) {
                $partnershipLevel = 'Tinggi';
            } elseif ($university->interns_count >= 5) {
                $partnershipLevel = 'Sedang';
            } elseif ($university->interns_count > 0) {
                $partnershipLevel = 'Rendah';
            } else {
                $partnershipLevel = 'Belum Bermitra';
            }

            $csv .= sprintf(
                "%s,%s,%s,%s,%s,%d,%d,%s,%s,%s,%s,%s,%s\n",
                '"' . str_replace('"', '""', $university->name) . '"',
                '"' . str_replace('"', '""', $university->short_name ?? '') . '"',
                '"' . str_replace('"', '""', $university->city) . '"',
                '"' . str_replace('"', '""', $university->province) . '"',
                '"' . str_replace('"', '""', $university->rector ?? '') . '"',
                $university->interns_count,
                $university->active_interns_count,
                $partnershipLevel,
                $university->is_active ? 'Aktif' : 'Nonaktif',
                $university->website ?? '',
                $university->email ?? '',
                $university->phone ?? '',
                '"' . str_replace('"', '""', $university->address ?? '') . '"'
            );
        }

        $filename = 'universitas-partner-pln-' . now()->format('Y-m-d-H-i-s') . '.csv';
        
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}