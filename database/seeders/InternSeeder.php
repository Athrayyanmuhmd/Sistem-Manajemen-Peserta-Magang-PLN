<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interns = [
            // IT Division
            [
                'name' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@usk.ac.id',
                'phone' => '081234567890',
                'university_id' => 1, // USK
                'major' => 'Teknik Informatika',
                'student_id' => '1906123456',
                'department_id' => 1,
                'division_id' => 1, // TI
                'supervisor' => 'Ir. Andi Kurniawan, M.T.',
                'start_date' => '2024-08-01',
                'end_date' => '2024-11-01',
                'status' => 'active',
                'address' => 'Jl. Teuku Nyak Arief No. 123, Banda Aceh',
                'emergency_contact' => 'Siti Nurhasanah',
                'emergency_phone' => '081987654321',
                'notes' => 'Mahasiswa berprestasi dengan IPK 3.8, fokus pada pengembangan sistem',
                'completion_percentage' => 60,
                'satisfaction_score' => 4.5,
                'project_assigned' => 'Sistem Monitoring Jaringan PLN',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@unimal.ac.id',
                'phone' => '082345678901',
                'university_id' => 4, // UNIMAL
                'major' => 'Sistem Informasi',
                'student_id' => '1906654321',
                'department_id' => 1,
                'division_id' => 1, // TI
                'supervisor' => 'Ir. Andi Kurniawan, M.T.',
                'start_date' => '2024-07-15',
                'end_date' => '2024-10-15',
                'status' => 'active',
                'address' => 'Jl. Medan-Banda Aceh No. 456, Lhokseumawe',
                'emergency_contact' => 'Ahmad Nurhaliza',
                'emergency_phone' => '082876543210',
                'notes' => 'Memiliki pengalaman dalam pengembangan web dan database',
                'completion_percentage' => 75,
                'satisfaction_score' => 4.2,
                'project_assigned' => 'Aplikasi Mobile Customer Service PLN',
            ],
            // Engineering Division
            [
                'name' => 'Muhammad Fadli',
                'email' => 'muhammad.fadli@pnl.ac.id',
                'phone' => '083456789012',
                'university_id' => 5, // PNL
                'major' => 'Teknik Elektro',
                'student_id' => '2006789123',
                'department_id' => 1,
                'division_id' => 14, // Engineering
                'supervisor' => 'Dr. Ir. Chairul Saleh, M.T.',
                'start_date' => '2024-06-01',
                'end_date' => '2024-09-01',
                'status' => 'completed',
                'address' => 'Jl. Banda Aceh-Medan KM 280, Lhokseumawe',
                'emergency_contact' => 'Wati Setiawan',
                'emergency_phone' => '083765432109',
                'notes' => 'Telah menyelesaikan magang dengan nilai sangat baik',
                'completion_percentage' => 100,
                'satisfaction_score' => 4.8,
                'project_assigned' => 'Desain Gardu Distribusi 20kV',
            ],
            // Operations Division
            [
                'name' => 'Rina Maharani',
                'email' => 'rina.maharani@unsam.ac.id',
                'phone' => '084567890123',
                'university_id' => 7, // UNSAM
                'major' => 'Teknik Elektro',
                'student_id' => '2006456789',
                'department_id' => 1,
                'division_id' => 6, // Operations
                'supervisor' => 'Ir. Zulkifli Ahmad, M.T.',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-01',
                'status' => 'pending',
                'address' => 'Jl. Merdeka No. 321, Langsa',
                'emergency_contact' => 'Dewi Maharani',
                'emergency_phone' => '084654321098',
                'notes' => 'Menunggu proses orientasi keselamatan kerja',
                'completion_percentage' => 0,
                'satisfaction_score' => null,
                'project_assigned' => 'Pemeliharaan Jaringan Distribusi Aceh Timur',
            ],
            // Finance Division
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@uin-ar-raniry.ac.id',
                'phone' => '085678901234',
                'university_id' => 2, // UIN Ar-Raniry
                'major' => 'Akuntansi Syariah',
                'student_id' => '2006987654',
                'department_id' => 1,
                'division_id' => 3, // Finance
                'supervisor' => 'Ir. Budi Santoso, M.Ak.',
                'start_date' => '2024-08-15',
                'end_date' => '2024-11-15',
                'status' => 'active',
                'address' => 'Jl. Syiah Kuala No. 654, Banda Aceh',
                'emergency_contact' => 'Andi Kurniawan',
                'emergency_phone' => '085543210987',
                'notes' => 'Mahasiswa semester akhir, tertarik pada audit keuangan',
                'completion_percentage' => 40,
                'satisfaction_score' => 4.1,
                'project_assigned' => 'Analisis Laporan Keuangan Q3 2024',
            ],
            // Construction Division  
            [
                'name' => 'Teuku Rizal',
                'email' => 'teuku.rizal@poltek-aceh.ac.id',
                'phone' => '086789012345',
                'university_id' => 3, // Politeknik Aceh
                'major' => 'Teknik Sipil',
                'student_id' => '2007123456',
                'department_id' => 1,
                'division_id' => 5, // Construction
                'supervisor' => 'Ir. Mahmud Syafei, M.T.',
                'start_date' => '2024-07-01',
                'end_date' => '2024-10-01',
                'status' => 'active',
                'address' => 'Jl. Politeknik No. 789, Banda Aceh',
                'emergency_contact' => 'Cut Nyak Dhien',
                'emergency_phone' => '086678901234',
                'notes' => 'Berpengalaman dalam proyek konstruksi infrastruktur',
                'completion_percentage' => 70,
                'satisfaction_score' => 4.3,
                'project_assigned' => 'Pembangunan Gardu Induk Lhokseumawe',
            ],
            // HR Division
            [
                'name' => 'Cut Meutia Sari',
                'email' => 'cut.meutia@utu.ac.id',
                'phone' => '087890123456',
                'university_id' => 6, // UTU
                'major' => 'Manajemen SDM',
                'student_id' => '2007234567',
                'department_id' => 1,
                'division_id' => 2, // HR
                'supervisor' => 'Dra. Sari Wulandari, M.M.',
                'start_date' => '2024-08-01',
                'end_date' => '2024-11-01',
                'status' => 'active',
                'address' => 'Jl. Alue Penyareng No. 321, Meulaboh',
                'emergency_contact' => 'Teuku Iskandar',
                'emergency_phone' => '087789012345',
                'notes' => 'Fokus pada pengembangan sistem rekrutmen digital',
                'completion_percentage' => 55,
                'satisfaction_score' => 4.4,
                'project_assigned' => 'Digitalisasi Proses Rekrutmen Karyawan',
            ],
            // Customer Service Division
            [
                'name' => 'Novi Rahmawati',
                'email' => 'novi.rahmawati@usu.ac.id',
                'phone' => '088901234567',
                'university_id' => 8, // USU
                'major' => 'Ilmu Komunikasi',
                'student_id' => '2007345678',
                'department_id' => 1,
                'division_id' => 7, // Customer Service
                'supervisor' => 'Dra. Nurul Fadillah, M.M.',
                'start_date' => '2024-06-15',
                'end_date' => '2024-09-15',
                'status' => 'completed',
                'address' => 'Jl. Dr. Mansyur No. 456, Medan',
                'emergency_contact' => 'Ratna Sari',
                'emergency_phone' => '088890123456',
                'notes' => 'Excellent dalam komunikasi dan pelayanan pelanggan',
                'completion_percentage' => 100,
                'satisfaction_score' => 4.9,
                'project_assigned' => 'Sistem CRM dan Customer Feedback',
            ],
            // Maintenance Division
            [
                'name' => 'Bayu Firmansyah',
                'email' => 'bayu.firmansyah@del.ac.id',
                'phone' => '089012345678',
                'university_id' => 9, // IT Del
                'major' => 'Teknik Elektro',
                'student_id' => '2007456789',
                'department_id' => 1,
                'division_id' => 13, // Maintenance
                'supervisor' => 'Ir. Iskandar Muda, M.T.',
                'start_date' => '2024-07-15',
                'end_date' => '2024-10-15',
                'status' => 'active',
                'address' => 'Jl. Sisingamangaraja No. 789, Toba Samosir',
                'emergency_contact' => 'Linda Simanjuntak',
                'emergency_phone' => '089901234567',
                'notes' => 'Ahli dalam maintenance peralatan elektronik dan kontrol',
                'completion_percentage' => 65,
                'satisfaction_score' => 4.2,
                'project_assigned' => 'Predictive Maintenance System SCADA',
            ],
            // Safety Division (K3)
            [
                'name' => 'Fitri Handayani',
                'email' => 'fitri.handayani@unand.ac.id',
                'phone' => '081123456789',
                'university_id' => 11, // UNAND
                'major' => 'Teknik Industri',
                'student_id' => '2007567890',
                'department_id' => 1,
                'division_id' => 8, // K3
                'supervisor' => 'Ir. Teuku Rizki, M.T.',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-01',
                'status' => 'active',
                'address' => 'Jl. Perintis Kemerdekaan No. 123, Padang',
                'emergency_contact' => 'Budi Handayani',
                'emergency_phone' => '081012345678',
                'notes' => 'Fokus pada implementasi sistem manajemen K3',
                'completion_percentage' => 25,
                'satisfaction_score' => 4.0,
                'project_assigned' => 'Risk Assessment Gardu Distribusi',
            ],
        ];

        foreach ($interns as $intern) {
            \App\Models\Intern::create($intern);
        }
    }
}
