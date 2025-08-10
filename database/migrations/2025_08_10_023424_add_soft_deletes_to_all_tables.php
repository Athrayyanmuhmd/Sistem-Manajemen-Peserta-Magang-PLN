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
        // Add soft deletes to interns table
        Schema::table('interns', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to departments table
        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('code', 10)->nullable()->unique()->after('name');
            $table->string('contact_phone', 20)->nullable()->after('contact_email');
            $table->string('location')->nullable()->after('contact_phone');
            $table->integer('capacity')->default(10)->after('location');
        });

        // Add soft deletes to divisions table
        Schema::table('divisions', function (Blueprint $table) {
            $table->softDeletes();
            $table->decimal('budget', 15, 2)->nullable()->after('location');
        });

        // Add soft deletes to universities table
        Schema::table('universities', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('accreditation', 20)->nullable()->after('type');
            $table->integer('established_year')->nullable()->after('accreditation');
            $table->string('address')->nullable()->after('website');
            $table->date('partnership_start_date')->nullable()->after('address');
        });

        // Add indexes for better performance
        Schema::table('interns', function (Blueprint $table) {
            $table->index(['status', 'deleted_at']);
            $table->index(['department_id', 'deleted_at']);
            $table->index(['university_id', 'deleted_at']);
            $table->index(['division_id', 'deleted_at']);
            $table->index(['start_date', 'end_date']);
            $table->index('student_id');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->index(['is_active', 'deleted_at']);
            $table->index('code');
        });

        Schema::table('divisions', function (Blueprint $table) {
            $table->index(['is_active', 'deleted_at']);
            $table->index('code');
        });

        Schema::table('universities', function (Blueprint $table) {
            $table->index(['is_active', 'deleted_at']);
            $table->index(['type', 'deleted_at']);
            $table->index(['province', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes first
        Schema::table('interns', function (Blueprint $table) {
            $table->dropIndex(['status', 'deleted_at']);
            $table->dropIndex(['department_id', 'deleted_at']);
            $table->dropIndex(['university_id', 'deleted_at']);
            $table->dropIndex(['division_id', 'deleted_at']);
            $table->dropIndex(['start_date', 'end_date']);
            $table->dropIndex(['student_id']);
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'deleted_at']);
            $table->dropIndex(['code']);
        });

        Schema::table('divisions', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'deleted_at']);
            $table->dropIndex(['code']);
        });

        Schema::table('universities', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'deleted_at']);
            $table->dropIndex(['type', 'deleted_at']);
            $table->dropIndex(['province', 'city']);
        });

        // Remove soft deletes columns
        Schema::table('interns', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['code', 'contact_phone', 'location', 'capacity']);
        });

        Schema::table('divisions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('budget');
        });

        Schema::table('universities', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['accreditation', 'established_year', 'address', 'partnership_start_date']);
        });
    }
};
