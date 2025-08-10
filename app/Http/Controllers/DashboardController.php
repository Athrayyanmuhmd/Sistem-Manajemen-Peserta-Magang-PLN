<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use App\Models\Department;
use App\Models\University;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = $this->getOverviewStats();
        $charts = $this->getChartData();
        $alerts = $this->getAlerts();
        $recent_activity = $this->getRecentActivity();
        $progress_highlights = $this->getProgressHighlights();

        // Use PLN dashboard view if accessed via PLN route
        $view = request()->routeIs('pln.dashboard') ? 'dashboard.pln-index' : 'dashboard.index';
        
        return view($view, compact('stats', 'charts', 'alerts', 'recent_activity', 'progress_highlights'));
    }

    private function getOverviewStats()
    {
        $currentMonth = now()->format('Y-m');
        $lastMonth = now()->subMonth()->format('Y-m');

        $currentTotal = Intern::count();
        $lastMonthTotal = Intern::whereDate('created_at', '<', now()->startOfMonth())->count();
        
        $currentActive = Intern::where('status', 'active')->count();
        $lastMonthActive = Intern::where('status', 'active')
            ->whereDate('created_at', '<', now()->startOfMonth())
            ->count();

        return [
            'total_interns' => $currentTotal,
            'total_change' => $this->calculatePercentageChange($currentTotal, $lastMonthTotal),
            'active_interns' => $currentActive,
            'active_change' => $this->calculatePercentageChange($currentActive, $lastMonthActive),
            'total_divisions' => Division::where('is_active', true)->count(),
            'division_change' => '+2',
            'total_universities' => University::where('is_active', true)->count(),
            'university_change' => '+3',
            'completion_rate' => $this->getCompletionRate(),
            'avg_duration' => $this->getAverageDuration(),
            'capacity_utilization' => $this->getCapacityUtilization(),
        ];
    }

    private function getChartData()
    {
        return [
            'status_distribution' => $this->getStatusDistribution(),
            'division_analytics' => $this->getDivisionAnalytics(),
            'university_insights' => $this->getUniversityInsights(),
            'timeline_data' => $this->getTimelineData(),
            'geographic_data' => $this->getGeographicData(),
            'performance_metrics' => $this->getPerformanceMetrics(),
        ];
    }

    private function getStatusDistribution()
    {
        return Intern::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => ucfirst($item->status),
                    'value' => $item->count,
                    'percentage' => round(($item->count / Intern::count()) * 100, 1)
                ];
            });
    }

    private function getDivisionAnalytics()
    {
        return Division::withCount(['interns', 'activeInterns'])
            ->orderBy('active_interns_count', 'desc')
            ->take(15)
            ->get()
            ->map(function ($division) {
                return [
                    'name' => $division->name,
                    'total' => $division->interns_count,
                    'active' => $division->active_interns_count,
                    'capacity' => $division->capacity,
                    'utilization' => $division->utilization_percentage,
                    'trend' => rand(-10, 20), // This would be calculated from historical data
                ];
            });
    }

    private function getUniversityInsights()
    {
        return University::withCount(['interns', 'activeInterns'])
            ->having('interns_count', '>', 0)
            ->orderBy('interns_count', 'desc')
            ->get()
            ->map(function ($university) {
                $majors = Intern::where('university_id', $university->id)
                    ->select('major', DB::raw('count(*) as count'))
                    ->groupBy('major')
                    ->get();

                return [
                    'name' => $university->name,
                    'short_name' => $university->short_name,
                    'city' => $university->city,
                    'province' => $university->province,
                    'total' => $university->interns_count,
                    'active' => $university->active_interns_count,
                    'majors' => $majors->count(),
                    'latitude' => $university->latitude,
                    'longitude' => $university->longitude,
                ];
            });
    }

    private function getTimelineData()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthStr = $month->format('Y-m');
            
            $started = Intern::whereYear('start_date', $month->year)
                ->whereMonth('start_date', $month->month)
                ->count();
            
            $completed = Intern::whereYear('end_date', $month->year)
                ->whereMonth('end_date', $month->month)
                ->where('status', 'completed')
                ->count();

            $months->push([
                'month' => $month->format('M Y'),
                'started' => $started,
                'completed' => $completed,
                'net_change' => $started - $completed,
            ]);
        }

        return $months;
    }

    private function getGeographicData()
    {
        return University::select('province', DB::raw('count(*) as university_count'), DB::raw('sum((select count(*) from interns where universities.id = interns.university_id)) as interns_count'))
            ->groupBy('province')
            ->havingRaw('interns_count > 0')
            ->get()
            ->map(function ($item) {
                return [
                    'province' => $item->province,
                    'universities' => $item->university_count,
                    'interns' => $item->interns_count,
                ];
            });
    }

    private function getPerformanceMetrics()
    {
        $totalInterns = Intern::count();
        $completedInterns = Intern::where('status', 'completed')->count();
        
        return [
            'completion_rate' => $totalInterns > 0 ? round(($completedInterns / $totalInterns) * 100, 1) : 0,
            'avg_duration' => round(Intern::whereNotNull('start_date')
                ->whereNotNull('end_date')
                ->selectRaw('AVG(DATEDIFF(end_date, start_date)) as avg_days')
                ->value('avg_days') ?? 0),
            'avg_satisfaction' => round(Intern::whereNotNull('satisfaction_score')
                ->avg('satisfaction_score') ?? 0, 1),
            'retention_rate' => 85.5, // This would be calculated based on extensions/early terminations
        ];
    }

    private function getAlerts()
    {
        $alerts = collect();

        // Interns finishing soon
        $finishingSoon = Intern::where('status', 'active')
            ->whereBetween('end_date', [now(), now()->addDays(7)])
            ->count();

        if ($finishingSoon > 0) {
            $alerts->push([
                'type' => 'warning',
                'message' => "{$finishingSoon} peserta akan selesai dalam 7 hari",
                'action' => 'Siapkan evaluasi dan sertifikat',
                'count' => $finishingSoon
            ]);
        }

        // Over capacity divisions
        $overCapacity = Division::withCount('activeInterns')
            ->get()
            ->filter(function ($division) {
                return $division->active_interns_count > $division->capacity;
            });

        if ($overCapacity->count() > 0) {
            $alerts->push([
                'type' => 'danger',
                'message' => "{$overCapacity->count()} divisi melebihi kapasitas",
                'action' => 'Review alokasi peserta',
                'count' => $overCapacity->count()
            ]);
        }

        return $alerts;
    }

    private function getRecentActivity()
    {
        return Intern::with(['university', 'division'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($intern) {
                return [
                    'name' => $intern->name,
                    'action' => 'started internship',
                    'division' => $intern->division->name ?? 'Unknown',
                    'university' => $intern->university->short_name ?? $intern->university->name ?? 'Unknown',
                    'time' => $intern->created_at->diffForHumans(),
                    'status' => $intern->status
                ];
            });
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) return $current > 0 ? '+100%' : '0%';
        
        $change = (($current - $previous) / $previous) * 100;
        return ($change >= 0 ? '+' : '') . round($change, 1) . '%';
    }

    private function getCompletionRate()
    {
        $total = Intern::count();
        $completed = Intern::where('status', 'completed')->count();
        
        return $total > 0 ? round(($completed / $total) * 100, 1) : 0;
    }

    private function getAverageDuration()
    {
        return round(Intern::whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->selectRaw('AVG(DATEDIFF(end_date, start_date)) as avg_days')
            ->value('avg_days') ?? 78);
    }

    private function getCapacityUtilization()
    {
        $totalCapacity = Division::sum('capacity');
        $totalActive = Intern::where('status', 'active')->count();
        
        return $totalCapacity > 0 ? round(($totalActive / $totalCapacity) * 100, 1) : 0;
    }

    public function analytics()
    {
        $analytics = [
            'overview' => $this->getAnalyticsOverview(),
            'trends' => $this->getAnalyticsTrends(),
            'divisions' => $this->getDivisionsAnalytics(),
            'universities' => $this->getUniversitiesAnalytics(),
            'performance' => $this->getPerformanceAnalytics(),
            'geographic' => $this->getGeographicAnalytics(),
        ];

        return view('analytics.index', compact('analytics'));
    }

    private function getAnalyticsOverview()
    {
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        return [
            'total_interns_current' => Intern::whereYear('created_at', $currentYear)->count(),
            'total_interns_last' => Intern::whereYear('created_at', $lastYear)->count(),
            'active_now' => Intern::where('status', 'active')->count(),
            'completed_this_year' => Intern::where('status', 'completed')->whereYear('end_date', $currentYear)->count(),
            'avg_duration' => $this->getAverageDuration(),
            'success_rate' => $this->getSuccessRate(),
        ];
    }

    private function getAnalyticsTrends()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStr = $date->format('Y-m');
            
            $started = Intern::whereYear('start_date', $date->year)
                ->whereMonth('start_date', $date->month)
                ->count();
            
            $completed = Intern::whereYear('end_date', $date->year)
                ->whereMonth('end_date', $date->month)
                ->where('status', 'completed')
                ->count();

            $months->push([
                'month' => $date->format('M Y'),
                'started' => $started,
                'completed' => $completed,
                'active_end' => Intern::where('status', 'active')
                    ->where('start_date', '<=', $date->endOfMonth())
                    ->count(),
            ]);
        }
        return $months;
    }

    private function getDivisionsAnalytics()
    {
        return Division::withCount(['interns', 'activeInterns'])
            ->with(['interns' => function($query) {
                $query->select('division_id', 'satisfaction_score', 'completion_percentage')
                    ->whereNotNull('satisfaction_score');
            }])
            ->get()
            ->map(function ($division) {
                return [
                    'name' => $division->name,
                    'code' => $division->code,
                    'total_interns' => $division->interns_count,
                    'active_interns' => $division->active_interns_count,
                    'capacity' => $division->capacity,
                    'utilization' => $division->utilization_percentage,
                    'avg_satisfaction' => $division->interns->avg('satisfaction_score'),
                    'avg_completion' => $division->interns->avg('completion_percentage'),
                ];
            })
            ->sortByDesc('total_interns');
    }

    private function getUniversitiesAnalytics()
    {
        return University::withCount(['interns', 'activeInterns'])
            ->with(['interns' => function($query) {
                $query->select('university_id', 'satisfaction_score', 'completion_percentage', 'major')
                    ->whereNotNull('satisfaction_score');
            }])
            ->having('interns_count', '>', 0)
            ->get()
            ->map(function ($university) {
                $majors = $university->interns->groupBy('major')->map->count()->sortDesc();
                return [
                    'name' => $university->name,
                    'short_name' => $university->short_name,
                    'city' => $university->city,
                    'province' => $university->province,
                    'total_interns' => $university->interns_count,
                    'active_interns' => $university->active_interns_count,
                    'avg_satisfaction' => $university->interns->avg('satisfaction_score'),
                    'avg_completion' => $university->interns->avg('completion_percentage'),
                    'top_majors' => $majors->take(3)->keys(),
                    'major_diversity' => $majors->count(),
                ];
            })
            ->sortByDesc('total_interns');
    }

    private function getPerformanceAnalytics()
    {
        return [
            'satisfaction_distribution' => Intern::whereNotNull('satisfaction_score')
                ->selectRaw('
                    CASE 
                        WHEN satisfaction_score >= 4.5 THEN "Sangat Puas"
                        WHEN satisfaction_score >= 3.5 THEN "Puas"
                        WHEN satisfaction_score >= 2.5 THEN "Cukup"
                        WHEN satisfaction_score >= 1.5 THEN "Kurang"
                        ELSE "Sangat Kurang"
                    END as category,
                    COUNT(*) as count
                ')
                ->groupByRaw('category')
                ->get(),
            
            'completion_distribution' => Intern::whereNotNull('completion_percentage')
                ->selectRaw('
                    CASE 
                        WHEN completion_percentage >= 90 THEN "90-100%"
                        WHEN completion_percentage >= 75 THEN "75-89%"
                        WHEN completion_percentage >= 50 THEN "50-74%"
                        WHEN completion_percentage >= 25 THEN "25-49%"
                        ELSE "0-24%"
                    END as category,
                    COUNT(*) as count
                ')
                ->groupByRaw('category')
                ->get(),

            'status_trends' => $this->getStatusTrends(),
        ];
    }

    private function getGeographicAnalytics()
    {
        return University::select('province', DB::raw('count(*) as universities_count'))
            ->groupBy('province')
            ->get()
            ->map(function ($item) {
                $totalInterns = Intern::whereHas('university', function($query) use ($item) {
                    $query->where('province', $item->province);
                })->count();
                
                $activeInterns = Intern::whereHas('university', function($query) use ($item) {
                    $query->where('province', $item->province);
                })->where('status', 'active')->count();

                return [
                    'province' => $item->province,
                    'universities' => $item->universities_count,
                    'total_interns' => $totalInterns,
                    'active_interns' => $activeInterns,
                ];
            })
            ->where('total_interns', '>', 0)
            ->sortByDesc('total_interns');
    }

    private function getSuccessRate()
    {
        $total = Intern::count();
        $successful = Intern::where('status', 'completed')
            ->where('completion_percentage', '>=', 80)
            ->count();
        
        return $total > 0 ? round(($successful / $total) * 100, 1) : 0;
    }

    private function getStatusTrends()
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            
            $statuses = Intern::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status');

            $months->push([
                'month' => $date->format('M Y'),
                'pending' => $statuses->get('pending', 0),
                'active' => $statuses->get('active', 0),
                'completed' => $statuses->get('completed', 0),
                'terminated' => $statuses->get('terminated', 0),
            ]);
        }
        return $months;
    }

    public function exportAnalytics()
    {
        $analytics = [
            'overview' => $this->getAnalyticsOverview(),
            'trends' => $this->getAnalyticsTrends(),
            'divisions' => $this->getDivisionsAnalytics(),
            'universities' => $this->getUniversitiesAnalytics(),
            'performance' => $this->getPerformanceAnalytics(),
            'geographic' => $this->getGeographicAnalytics(),
        ];

        $csv = "=== LAPORAN ANALYTICS PLN UID ACEH ===\n";
        $csv .= "Tanggal Ekspor: " . now()->format('d/m/Y H:i:s') . "\n\n";

        // Overview Section
        $csv .= "=== RINGKASAN UMUM ===\n";
        $csv .= "Total Peserta 2025," . $analytics['overview']['total_interns_current'] . "\n";
        $csv .= "Total Peserta 2024," . $analytics['overview']['total_interns_last'] . "\n";
        $csv .= "Peserta Aktif Saat Ini," . $analytics['overview']['active_now'] . "\n";
        $csv .= "Selesai Tahun Ini," . $analytics['overview']['completed_this_year'] . "\n";
        $csv .= "Rata-rata Durasi (hari)," . $analytics['overview']['avg_duration'] . "\n";
        $csv .= "Tingkat Keberhasilan (%)," . $analytics['overview']['success_rate'] . "\n\n";

        // Divisions Analytics
        $csv .= "=== ANALISIS DIVISI ===\n";
        $csv .= "Nama Divisi,Kode,Total Peserta,Peserta Aktif,Kapasitas,Utilisasi (%),Rata-rata Kepuasan,Rata-rata Penyelesaian\n";
        foreach ($analytics['divisions'] as $division) {
            $csv .= sprintf(
                "%s,%s,%d,%d,%d,%.1f,%.1f,%.1f\n",
                '"' . str_replace('"', '""', $division['name']) . '"',
                $division['code'],
                $division['total_interns'],
                $division['active_interns'],
                $division['capacity'],
                $division['utilization'],
                $division['avg_satisfaction'] ?? 0,
                $division['avg_completion'] ?? 0
            );
        }

        // Universities Analytics
        $csv .= "\n=== ANALISIS UNIVERSITAS ===\n";
        $csv .= "Nama Universitas,Singkatan,Kota,Provinsi,Total Peserta,Peserta Aktif,Rata-rata Kepuasan,Keragaman Jurusan\n";
        foreach ($analytics['universities'] as $university) {
            $csv .= sprintf(
                "%s,%s,%s,%s,%d,%d,%.1f,%d\n",
                '"' . str_replace('"', '""', $university['name']) . '"',
                '"' . str_replace('"', '""', $university['short_name'] ?? '') . '"',
                '"' . str_replace('"', '""', $university['city']) . '"',
                '"' . str_replace('"', '""', $university['province']) . '"',
                $university['total_interns'],
                $university['active_interns'],
                $university['avg_satisfaction'] ?? 0,
                $university['major_diversity']
            );
        }

        // Geographic Analytics
        $csv .= "\n=== ANALISIS GEOGRAFIS ===\n";
        $csv .= "Provinsi,Jumlah Universitas,Total Peserta,Peserta Aktif\n";
        foreach ($analytics['geographic'] as $region) {
            $csv .= sprintf(
                "%s,%d,%d,%d\n",
                '"' . str_replace('"', '""', $region['province']) . '"',
                $region['universities'],
                $region['total_interns'],
                $region['active_interns']
            );
        }

        // Trends Data
        $csv .= "\n=== TREN BULANAN ===\n";
        $csv .= "Bulan,Mulai Magang,Selesai Magang,Aktif Akhir Bulan\n";
        foreach ($analytics['trends'] as $trend) {
            $csv .= sprintf(
                "%s,%d,%d,%d\n",
                $trend['month'],
                $trend['started'],
                $trend['completed'],
                $trend['active_end']
            );
        }

        $filename = 'laporan-analytics-pln-' . now()->format('Y-m-d-H-i-s') . '.csv';
        
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function liveStats()
    {
        $stats = [
            'total_interns' => Intern::count(),
            'active_interns' => Intern::where('status', 'active')->count(),
            'total_divisions' => Division::where('is_active', true)->count(),
            'total_universities' => University::where('is_active', true)->count(),
            'completion_rate' => $this->getCompletionRate(),
            'avg_duration' => $this->getAverageDuration(),
            'capacity_utilization' => $this->getCapacityUtilization(),
        ];

        return response()->json($stats);
    }

    private function getProgressHighlights()
    {
        $today = Carbon::today();
        
        return [
            'active_with_progress' => Intern::where('status', 'active')
                ->whereNotNull('start_date')
                ->whereNotNull('end_date')
                ->with(['division', 'university'])
                ->orderByRaw('CASE 
                    WHEN end_date < ? THEN 1 
                    WHEN DATEDIFF(end_date, ?) <= 7 THEN 2 
                    WHEN DATEDIFF(?, start_date) / DATEDIFF(end_date, start_date) >= 0.9 THEN 3
                    ELSE 4 
                END', [$today, $today, $today])
                ->take(8)
                ->get(),
            
            'starting_soon' => Intern::where('status', 'pending')
                ->whereBetween('start_date', [$today, $today->copy()->addDays(7)])
                ->with(['division', 'university'])
                ->orderBy('start_date')
                ->take(5)
                ->get(),
                
            'ending_soon' => Intern::where('status', 'active')
                ->whereBetween('end_date', [$today, $today->copy()->addDays(14)])
                ->with(['division', 'university'])
                ->orderBy('end_date')
                ->take(5)
                ->get(),
                
            'at_risk' => Intern::where('status', 'active')
                ->whereNotNull('start_date')
                ->whereNotNull('end_date')
                ->whereRaw('DATEDIFF(end_date, ?) <= 7 AND DATEDIFF(?, start_date) / DATEDIFF(end_date, start_date) < 0.8', [$today, $today])
                ->with(['division', 'university'])
                ->orderBy('end_date')
                ->take(5)
                ->get(),
                
            'progress_summary' => [
                'on_track' => Intern::where('status', 'active')
                    ->whereNotNull('start_date')
                    ->whereNotNull('end_date')
                    ->whereRaw('DATEDIFF(?, start_date) / DATEDIFF(end_date, start_date) BETWEEN 0.4 AND 1.2', [$today])
                    ->count(),
                    
                'at_risk' => Intern::where('status', 'active')
                    ->whereNotNull('start_date')
                    ->whereNotNull('end_date')
                    ->whereRaw('DATEDIFF(end_date, ?) <= 7 AND DATEDIFF(?, start_date) / DATEDIFF(end_date, start_date) < 0.8', [$today, $today])
                    ->count(),
                    
                'overdue' => Intern::where('status', 'active')
                    ->whereDate('end_date', '<', $today)
                    ->count(),
                    
                'completing_this_week' => Intern::where('status', 'active')
                    ->whereBetween('end_date', [$today, $today->copy()->addDays(7)])
                    ->count(),
            ]
        ];
    }
}
