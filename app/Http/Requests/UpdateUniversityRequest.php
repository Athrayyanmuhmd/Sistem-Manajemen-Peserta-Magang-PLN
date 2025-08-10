<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\University;

class UpdateUniversityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return University::rules($this->route('university')->id ?? $this->route('id'));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama universitas wajib diisi.',
            'city.required' => 'Kota wajib diisi.',
            'province.required' => 'Provinsi wajib diisi.',
            'type.required' => 'Jenis universitas wajib dipilih.',
            'type.in' => 'Jenis universitas tidak valid.',
            'contact_email.email' => 'Format email tidak valid.',
            'contact_phone.regex' => 'Format nomor telepon tidak valid.',
            'website.url' => 'Format website tidak valid.',
            'latitude.numeric' => 'Koordinat lintang harus berupa angka.',
            'longitude.numeric' => 'Koordinat bujur harus berupa angka.',
            'established_year.integer' => 'Tahun didirikan harus berupa angka.',
            'established_year.min' => 'Tahun didirikan tidak valid.',
            'established_year.max' => 'Tahun didirikan tidak boleh melebihi tahun sekarang.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Universitas',
            'short_name' => 'Nama Singkat',
            'city' => 'Kota',
            'province' => 'Provinsi',
            'type' => 'Jenis',
            'accreditation' => 'Akreditasi',
            'established_year' => 'Tahun Didirikan',
            'latitude' => 'Lintang',
            'longitude' => 'Bujur',
            'contact_person' => 'Kontak Person',
            'contact_email' => 'Email Kontak',
            'contact_phone' => 'Telepon Kontak',
            'website' => 'Website',
            'address' => 'Alamat',
            'partnership_start_date' => 'Tanggal Mulai Kerjasama',
            'is_active' => 'Status Aktif',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('contact_phone') && $this->contact_phone) {
            $this->merge(['contact_phone' => preg_replace('/[^\d\-\+\(\)\s]/', '', $this->contact_phone)]);
        }

        // Format website URL
        if ($this->has('website') && $this->website && !str_starts_with($this->website, 'http')) {
            $this->merge(['website' => 'https://' . $this->website]);
        }
    }
}