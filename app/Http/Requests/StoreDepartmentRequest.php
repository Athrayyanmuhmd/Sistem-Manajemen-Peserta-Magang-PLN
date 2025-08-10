<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Department;

class StoreDepartmentRequest extends FormRequest
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
        return Department::rules();
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama departemen wajib diisi.',
            'code.unique' => 'Kode departemen sudah digunakan.',
            'contact_email.email' => 'Format email tidak valid.',
            'contact_phone.regex' => 'Format nomor telepon tidak valid.',
            'capacity.required' => 'Kapasitas departemen wajib diisi.',
            'capacity.integer' => 'Kapasitas harus berupa angka.',
            'capacity.min' => 'Kapasitas minimal 1 orang.',
            'capacity.max' => 'Kapasitas maksimal 1000 orang.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Departemen',
            'code' => 'Kode Departemen',
            'description' => 'Deskripsi',
            'head_of_department' => 'Kepala Departemen',
            'contact_email' => 'Email Kontak',
            'contact_phone' => 'Telepon Kontak',
            'location' => 'Lokasi',
            'capacity' => 'Kapasitas',
            'is_active' => 'Status Aktif',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean and format code
        if ($this->has('code') && $this->code) {
            $this->merge([
                'code' => strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $this->code))
            ]);
        }

        // Clean phone number
        if ($this->has('contact_phone') && $this->contact_phone) {
            $this->merge([
                'contact_phone' => preg_replace('/[^\d\-\+\(\)\s]/', '', $this->contact_phone)
            ]);
        }

        // Set default is_active
        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }
}