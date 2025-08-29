<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\University;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInternRequest;

class UserApplicationController extends Controller
{
    /**
     * Show the application form
     */
    public function showForm()
    {
        return view('user.apply');
    }

    /**
     * Store the internship application
     */
    public function store(Request $request)
    {
        // Debug: Log the incoming request (can be removed in production)
        \Log::info('New internship application received from: ' . $request->input('name'));

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'university_id' => 'required|exists:universities,id',
            'major' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'division_id' => 'required|exists:divisions,id',
            'whatsapp' => 'required|string|max:20',
            'nametag' => 'required|string|max:100',
            'duration_months' => 'required|integer|min:1|max:12',
        ]);

        // Set default status as pending
        $validated['status'] = 'pending';
        
        // Set department_id based on division (assuming division belongs to a department)
        $division = Division::find($validated['division_id']);
        $validated['department_id'] = $division->department_id ?? 1;
        
        // Generate email from name and nim for form submissions
        $validated['email'] = strtolower(str_replace(' ', '.', $validated['name'])) . '.' . $validated['nim'] . '@intern.pln.co.id';
        
        // Set student_id same as nim for form submissions
        $validated['student_id'] = $validated['nim'];

        // Debug: Log final data before create
        \Log::info('Data to be inserted:', $validated);

        try {
            // Ensure email and student_id are definitely set
            if (empty($validated['email'])) {
                $validated['email'] = strtolower(str_replace(' ', '.', $validated['name'])) . '.' . $validated['nim'] . '@intern.pln.co.id';
            }
            if (empty($validated['student_id'])) {
                $validated['student_id'] = $validated['nim'];
            }
            
            // Alternative approach: explicit creation
            $intern = new Intern();
            $intern->fill($validated);
            $intern->save();
            
            // Update email and student_id if they're still null after save
            if (empty($intern->email)) {
                $intern->email = strtolower(str_replace(' ', '.', $intern->name)) . '.' . $intern->nim . '@intern.pln.co.id';
            }
            if (empty($intern->student_id)) {
                $intern->student_id = $intern->nim;
            }
            $intern->save();
            
            \Log::info('Intern created successfully', ['intern_id' => $intern->id, 'email' => $intern->email]);
            
            return redirect()
                ->route('intern.application.success')
                ->with('success', 'Pendaftaran magang berhasil dikirim! Kami akan menghubungi Anda segera.');
                
        } catch (\Exception $e) {
            \Log::error('Error creating intern', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('user.success');
    }
}