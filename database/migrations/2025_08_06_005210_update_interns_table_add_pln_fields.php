<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->foreignId('university_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('division_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('completion_percentage')->default(0);
            $table->decimal('satisfaction_score', 3, 2)->nullable();
            $table->json('skills_gained')->nullable();
            $table->string('project_assigned')->nullable();
            $table->dropColumn('university');
        });
    }

    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropForeign(['university_id']);
            $table->dropForeign(['division_id']);
            $table->dropColumn([
                'university_id',
                'division_id',
                'completion_percentage',
                'satisfaction_score',
                'skills_gained',
                'project_assigned'
            ]);
            $table->string('university');
        });
    }
};
