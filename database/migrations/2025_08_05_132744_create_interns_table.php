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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('university');
            $table->string('major');
            $table->string('student_id');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('supervisor')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'active', 'completed', 'terminated'])->default('pending');
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
