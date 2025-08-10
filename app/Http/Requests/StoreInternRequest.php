<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Intern;

class StoreInternRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Add proper authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Intern::rules();
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama peserta magang wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'university_id.required' => 'Universitas wajib dipilih.',
            'university_id.exists' => 'Universitas tidak ditemukan.',
            'major.required' => 'Program studi wajib diisi.',
            'student_id.required' => 'NIM/NPM wajib diisi.',
            'student_id.unique' => 'NIM/NPM sudah terdaftar.',
            'department_id.required' => 'Departemen wajib dipilih.',
            'department_id.exists' => 'Departemen tidak ditemukan.',
            'division_id.required' => 'Divisi PLN wajib dipilih.',
            'division_id.exists' => 'Divisi PLN tidak ditemukan.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Format tanggal selesai tidak valid.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'emergency_phone.regex' => 'Format nomor telepon darurat tidak valid.',
            'completion_percentage.integer' => 'Persentase penyelesaian harus berupa angka.',
            'completion_percentage.min' => 'Persentase penyelesaian minimal 0%.',
            'completion_percentage.max' => 'Persentase penyelesaian maksimal 100%.',
            'satisfaction_score.numeric' => 'Skor kepuasan harus berupa angka.',
            'satisfaction_score.min' => 'Skor kepuasan minimal 1.',
            'satisfaction_score.max' => 'Skor kepuasan maksimal 5.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'phone' => 'Nomor Telepon',
            'university_id' => 'Universitas',
            'major' => 'Program Studi',
            'student_id' => 'NIM/NPM',
            'department_id' => 'Departemen',
            'division_id' => 'Divisi PLN',
            'supervisor' => 'Pembimbing',
            'start_date' => 'Tanggal Mulai',
            'end_date' => 'Tanggal Selesai',
            'status' => 'Status',
            'address' => 'Alamat',
            'emergency_contact' => 'Kontak Darurat',
            'emergency_phone' => 'Telepon Darurat',
            'notes' => 'Catatan',
            'completion_percentage' => 'Persentase Penyelesaian',
            'satisfaction_score' => 'Skor Kepuasan',
            'skills_gained' => 'Keterampilan yang Diperoleh',
            'project_assigned' => 'Proyek yang Ditugaskan',
            'photo' => 'Foto',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean phone numbers
        if ($this->has('phone') && $this->phone) {
            $this->merge([
                'phone' => preg_replace('/[^\d\-\+\(\)\s]/', '', $this->phone)
            ]);
        }
        
        if ($this->has('emergency_phone') && $this->emergency_phone) {
            $this->merge([
                'emergency_phone' => preg_replace('/[^\d\-\+\(\)\s]/', '', $this->emergency_phone)
            ]);
        }

        // Set default completion_percentage
        if (!$this->has('completion_percentage')) {
            $this->merge(['completion_percentage' => 0]);
        }

        // Convert arrays from JSON if needed
        if ($this->has('skills_gained') && is_string($this->skills_gained)) {
            $this->merge(['skills_gained' => json_decode($this->skills_gained, true) ?: []]);
        }
        
        if ($this->has('project_assigned') && is_string($this->project_assigned)) {
            $this->merge(['project_assigned' => json_decode($this->project_assigned, true) ?: []]);
        }
    }
}