<?php

use App\Http\Controllers\Api\InternController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes (with throttling)
Route::middleware(['api.throttle:60,1'])->group(function () {
    // Health check endpoint
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'message' => 'API is healthy',
            'timestamp' => now()->toISOString(),
            'version' => config('app.version', '1.0.0')
        ]);
    });
});

// Protected API routes
Route::middleware(['auth:sanctum', 'api.throttle:120,1'])->group(function () {
    
    // Intern management routes
    Route::prefix('interns')->name('api.interns.')->group(function () {
        
        // Basic CRUD operations
        Route::middleware(['permission:interns.view'])->group(function () {
            Route::get('/', [InternController::class, 'index'])->name('index');
            Route::get('/statistics', [InternController::class, 'statistics'])->name('statistics');
            Route::get('/{intern}', [InternController::class, 'show'])->name('show');
        });

        Route::middleware(['permission:interns.create'])->group(function () {
            Route::post('/', [InternController::class, 'store'])->name('store');
        });

        Route::middleware(['permission:interns.edit'])->group(function () {
            Route::put('/{intern}', [InternController::class, 'update'])->name('update');
            Route::patch('/{intern}', [InternController::class, 'update'])->name('patch');
        });

        Route::middleware(['permission:interns.delete'])->group(function () {
            Route::delete('/{intern}', [InternController::class, 'destroy'])->name('destroy');
        });

        // Restore functionality for soft deletes
        Route::middleware(['role:admin,super_admin'])->group(function () {
            Route::post('/{id}/restore', [InternController::class, 'restore'])->name('restore');
        });
    });

    // Department management routes
    Route::prefix('departments')->name('api.departments.')->middleware(['permission:departments.view'])->group(function () {
        Route::get('/', function () {
            return response()->json([
                'success' => true,
                'message' => 'Departments endpoint - to be implemented',
                'data' => []
            ]);
        })->name('index');
    });

    // University management routes
    Route::prefix('universities')->name('api.universities.')->middleware(['permission:universities.view'])->group(function () {
        Route::get('/', function () {
            return response()->json([
                'success' => true,
                'message' => 'Universities endpoint - to be implemented',
                'data' => []
            ]);
        })->name('index');
    });

    // Division management routes
    Route::prefix('divisions')->name('api.divisions.')->middleware(['permission:divisions.view'])->group(function () {
        Route::get('/', function () {
            return response()->json([
                'success' => true,
                'message' => 'Divisions endpoint - to be implemented',
                'data' => []
            ]);
        })->name('index');
    });

    // Reports and analytics
    Route::prefix('reports')->name('api.reports.')->middleware(['permission:reports.view'])->group(function () {
        Route::get('/dashboard', function () {
            return response()->json([
                'success' => true,
                'message' => 'Dashboard reports endpoint - to be implemented',
                'data' => [
                    'total_interns' => \App\Models\Intern::count(),
                    'active_interns' => \App\Models\Intern::where('status', 'active')->count(),
                    'departments_count' => \App\Models\Department::count(),
                    'universities_count' => \App\Models\University::count(),
                ]
            ]);
        })->name('dashboard');
    });
});

// Error handling for API routes
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'API endpoint not found',
        'error' => 'The requested API endpoint does not exist'
    ], 404);
});