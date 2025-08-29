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
            $table->string('nim')->nullable()->after('name');
            $table->string('whatsapp')->nullable()->after('phone');
            $table->string('nametag')->nullable()->after('notes');
            $table->integer('duration_months')->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropColumn(['nim', 'whatsapp', 'nametag', 'duration_months']);
        });
    }
};
