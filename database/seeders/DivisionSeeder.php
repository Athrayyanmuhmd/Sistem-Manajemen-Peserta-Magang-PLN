<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            [
                'name' => 'Divisi Teknologi Informasi',
                'code' => 'TI',
                'description' => 'Divisi yang menangani pengembangan sistem informasi, infrastruktur IT, digitalisasi, dan cybersecurity PLN UID Aceh',
                'head_of_division' => 'Ir. Andi Kurniawan, M.T.',
                'contact_email' => 'ti@pln-aceh.co.id',
                'contact_phone' => '0651-7123456',
                'capacity' => 25,
                'location' => 'Lantai 3, Gedung Utama PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Sumber Daya Manusia',
                'code' => 'SDM',
                'description' => 'Divisi yang mengelola SDM, rekrutmen, pelatihan, dan pengembangan karyawan PLN UID Aceh',
                'head_of_division' => 'Dra. Sari Wulandari, M.M.',
                'contact_email' => 'sdm@pln-aceh.co.id',
                'contact_phone' => '0651-7123457',
                'capacity' => 15,
                'location' => 'Lantai 2, Gedung Utama PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Keuangan',
                'code' => 'KEU',
                'description' => 'Divisi yang mengelola keuangan, akuntansi, anggaran, dan pelaporan keuangan PLN UID Aceh',
                'head_of_division' => 'Ir. Budi Santoso, M.Ak.',
                'contact_email' => 'keuangan@pln-aceh.co.id',
                'contact_phone' => '0651-7123458',
                'capacity' => 20,
                'location' => 'Lantai 1, Gedung Utama PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Perencanaan',
                'code' => 'REN',
                'description' => 'Divisi yang menangani perencanaan strategis, business plan, dan pengembangan bisnis PLN UID Aceh',
                'head_of_division' => 'Dr. Ir. Rahman Hidayat, M.T.',
                'contact_email' => 'perencanaan@pln-aceh.co.id',
                'contact_phone' => '0651-7123459',
                'capacity' => 18,
                'location' => 'Lantai 4, Gedung Utama PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Konstruksi',
                'code' => 'KON',
                'description' => 'Divisi yang menangani pembangunan infrastruktur kelistrikan, jaringan distribusi, dan gardu',
                'head_of_division' => 'Ir. Mahmud Syafei, M.T.',
                'contact_email' => 'konstruksi@pln-aceh.co.id',
                'contact_phone' => '0651-7123460',
                'capacity' => 30,
                'location' => 'Gedung Workshop PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Operasi',
                'code' => 'OPS',
                'description' => 'Divisi yang menangani operasional harian sistem kelistrikan, pemeliharaan, dan monitoring',
                'head_of_division' => 'Ir. Zulkifli Ahmad, M.T.',
                'contact_email' => 'operasi@pln-aceh.co.id',
                'contact_phone' => '0651-7123461',
                'capacity' => 35,
                'location' => 'Control Room PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Pelayanan Pelanggan',
                'code' => 'PP',
                'description' => 'Divisi yang menangani layanan pelanggan, complaint handling, dan customer relationship management',
                'head_of_division' => 'Dra. Nurul Fadillah, M.M.',
                'contact_email' => 'pelayanan@pln-aceh.co.id',
                'contact_phone' => '0651-7123462',
                'capacity' => 22,
                'location' => 'Customer Service Center PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Keselamatan Ketenagakerjaan',
                'code' => 'K3',
                'description' => 'Divisi yang menangani keselamatan dan kesehatan kerja, risk management, dan compliance',
                'head_of_division' => 'Ir. Teuku Rizki, M.T.',
                'contact_email' => 'k3@pln-aceh.co.id',
                'contact_phone' => '0651-7123463',
                'capacity' => 12,
                'location' => 'Safety Center PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Komunikasi Korporat',
                'code' => 'KORKOM',
                'description' => 'Divisi yang menangani komunikasi eksternal, public relations, dan brand management PLN',
                'head_of_division' => 'Drs. Farid Wajdi, M.I.Kom.',
                'contact_email' => 'korkom@pln-aceh.co.id',
                'contact_phone' => '0651-7123464',
                'capacity' => 10,
                'location' => 'Media Center PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Hukum',
                'code' => 'HUK',
                'description' => 'Divisi yang menangani aspek legal, kontrak, compliance, dan advokasi hukum perusahaan',
                'head_of_division' => 'Dr. H. Yusuf Maulana, S.H., M.H.',
                'contact_email' => 'hukum@pln-aceh.co.id',
                'contact_phone' => '0651-7123465',
                'capacity' => 8,
                'location' => 'Legal Office PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Audit Internal',
                'code' => 'AI',
                'description' => 'Divisi yang menangani audit internal, risk assessment, dan sistem pengendalian internal',
                'head_of_division' => 'Ir. Cut Nyak Dien, M.M.',
                'contact_email' => 'audit@pln-aceh.co.id',
                'contact_phone' => '0651-7123466',
                'capacity' => 6,
                'location' => 'Audit Room PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Pengadaan',
                'code' => 'PGD',
                'description' => 'Divisi yang menangani procurement, vendor management, dan supply chain PLN UID Aceh',
                'head_of_division' => 'Ir. Muhammad Nizar, M.T.',
                'contact_email' => 'pengadaan@pln-aceh.co.id',
                'contact_phone' => '0651-7123467',
                'capacity' => 14,
                'location' => 'Procurement Center PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Maintenance',
                'code' => 'MNT',
                'description' => 'Divisi yang menangani pemeliharaan preventif dan korektif peralatan kelistrikan',
                'head_of_division' => 'Ir. Iskandar Muda, M.T.',
                'contact_email' => 'maintenance@pln-aceh.co.id',
                'contact_phone' => '0651-7123468',
                'capacity' => 28,
                'location' => 'Maintenance Workshop PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Engineering',
                'code' => 'ENG',
                'description' => 'Divisi yang menangani desain teknis, engineering study, dan inovasi teknologi kelistrikan',
                'head_of_division' => 'Dr. Ir. Chairul Saleh, M.T.',
                'contact_email' => 'engineering@pln-aceh.co.id',
                'contact_phone' => '0651-7123469',
                'capacity' => 24,
                'location' => 'Engineering Lab PLN UID Aceh',
                'is_active' => true,
            ],
            [
                'name' => 'Divisi Manajemen Aset',
                'code' => 'MA',
                'description' => 'Divisi yang menangani pengelolaan aset, inventarisasi, dan optimalisasi pemanfaatan aset',
                'head_of_division' => 'Ir. Rini Kurniasari, M.M.',
                'contact_email' => 'aset@pln-aceh.co.id',
                'contact_phone' => '0651-7123470',
                'capacity' => 16,
                'location' => 'Asset Management Center PLN UID Aceh',
                'is_active' => true,
            ],
        ];

        foreach ($divisions as $division) {
            \App\Models\Division::create($division);
        }
    }
}
