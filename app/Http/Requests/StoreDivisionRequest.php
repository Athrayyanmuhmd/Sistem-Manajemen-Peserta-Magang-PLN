<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Division;

class StoreDivisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return Division::rules();
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama divisi wajib diisi.',
            'code.required' => 'Kode divisi wajib diisi.',
            'code.unique' => 'Kode divisi sudah digunakan.',
            'contact_email.email' => 'Format email tidak valid.',
            'contact_phone.regex' => 'Format nomor telepon tidak valid.',
            'capacity.required' => 'Kapasitas divisi wajib diisi.',
            'capacity.integer' => 'Kapasitas harus berupa angka.',
            'capacity.min' => 'Kapasitas minimal 1 orang.',
            'budget.numeric' => 'Budget harus berupa angka.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Divisi',
            'code' => 'Kode Divisi',
            'description' => 'Deskripsi',
            'head_of_division' => 'Kepala Divisi',
            'contact_email' => 'Email Kontak',
            'contact_phone' => 'Telepon Kontak',
            'capacity' => 'Kapasitas',
            'location' => 'Lokasi',
            'budget' => 'Budget',
            'is_active' => 'Status Aktif',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('code') && $this->code) {
            $this->merge(['code' => strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $this->code))]);
        }
        
        if ($this->has('contact_phone') && $this->contact_phone) {
            $this->merge(['contact_phone' => preg_replace('/[^\d\-\+\(\)\s]/', '', $this->contact_phone)]);
        }

        if (!$this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }
}