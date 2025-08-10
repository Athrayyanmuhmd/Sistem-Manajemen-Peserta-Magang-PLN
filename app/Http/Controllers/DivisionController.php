<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $query = Division::withCount(['interns', 'activeInterns']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('head', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
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

        // Capacity utilization filter
        if ($request->filled('utilization')) {
            $utilization = $request->get('utilization');
            $query->whereRaw('(active_interns_count / capacity * 100) ' . 
                match($utilization) {
                    'low' => '< 50',
                    'medium' => 'BETWEEN 50 AND 85',
                    'high' => '> 85',
                    default => '> 0'
                }
            );
        }

        // Sort functionality
        $sortBy = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        
        $allowedSorts = ['name', 'code', 'capacity', 'interns_count', 'active_interns_count'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->orderBy('name');
        }

        $divisions = $query->paginate(12)->appends($request->query());

        return view('divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:divisions,code',
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'head' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        Division::create($validated);

        return redirect()->route('divisions.index')
            ->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function show(Division $division)
    {
        $division->loadCount(['interns', 'activeInterns']);
        $division->load(['interns' => function($query) {
            $query->with(['university', 'department'])->latest()->take(10);
        }]);

        // Get division statistics
        $stats = [
            'total_interns' => $division->interns_count,
            'active_interns' => $division->active_interns_count,
            'completion_rate' => $division->interns->where('status', 'completed')->count(),
            'capacity_utilization' => $division->capacity > 0 ? ($division->active_interns_count / $division->capacity) * 100 : 0,
            'avg_satisfaction' => $division->interns->whereNotNull('satisfaction_score')->avg('satisfaction_score'),
            'avg_completion' => $division->interns->whereNotNull('completion_percentage')->avg('completion_percentage'),
        ];

        return view('divisions.show', compact('division', 'stats'));
    }

    public function edit(Division $division)
    {
        return view('divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:divisions,code,' . $division->id,
            'description' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'head' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $division->update($validated);

        return redirect()->route('divisions.show', $division)
            ->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function destroy(Division $division)
    {
        if ($division->interns()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus divisi yang masih memiliki peserta magang.');
        }

        $division->delete();

        return redirect()->route('divisions.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = Division::withCount(['interns', 'activeInterns']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('head', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $divisions = $query->orderBy('name')->get();

        $csv = "Kode,Nama,Kepala Divisi,Lokasi,Kapasitas,Total Peserta,Peserta Aktif,Utilisasi (%),Status,Email,Telepon\n";
        
        foreach ($divisions as $division) {
            $utilization = $division->capacity > 0 ? round(($division->active_interns_count / $division->capacity) * 100, 1) : 0;
            $csv .= sprintf(
                "%s,%s,%s,%s,%d,%d,%d,%s,%s,%s,%s\n",
                $division->code,
                '"' . str_replace('"', '""', $division->name) . '"',
                '"' . str_replace('"', '""', $division->head ?? '') . '"',
                '"' . str_replace('"', '""', $division->location ?? '') . '"',
                $division->capacity,
                $division->interns_count,
                $division->active_interns_count,
                $utilization,
                $division->is_active ? 'Aktif' : 'Nonaktif',
                $division->contact_email ?? '',
                $division->contact_phone ?? ''
            );
        }

        $filename = 'divisi-pln-' . now()->format('Y-m-d-H-i-s') . '.csv';
        
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}