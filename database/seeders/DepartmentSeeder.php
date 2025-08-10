<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'description' => 'Departemen yang menangani pengembangan sistem informasi, infrastruktur IT, dan teknologi perusahaan.',
                'head_of_department' => 'Andi Prasetyo',
                'contact_email' => 'it@company.com',
                'is_active' => true,
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Departemen yang mengelola sumber daya manusia, rekrutmen, dan pengembangan karyawan.',
                'head_of_department' => 'Sari Wijaya',
                'contact_email' => 'hr@company.com',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'description' => 'Departemen yang bertanggung jawab atas strategi pemasaran dan promosi produk perusahaan.',
                'head_of_department' => 'Budi Santoso',
                'contact_email' => 'marketing@company.com',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'description' => 'Departemen yang mengelola keuangan, akuntansi, dan pelaporan keuangan perusahaan.',
                'head_of_department' => 'Linda Kusuma',
                'contact_email' => 'finance@company.com',
                'is_active' => true,
            ],
            [
                'name' => 'Operations',
                'description' => 'Departemen yang mengatur operasional harian dan proses bisnis perusahaan.',
                'head_of_department' => 'Rahman Hidayat',
                'contact_email' => 'ops@company.com',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {
            \App\Models\Department::create($department);
        }
    }
}
