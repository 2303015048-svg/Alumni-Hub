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
        Schema::table('users', function (Blueprint $table) {
            // Cek jika kolom 'about_me' belum ada, baru buat
            if (!Schema::hasColumn('users', 'about_me')) {
                $table->text('about_me')->nullable();
            }
            
            // Cek dan buat kolom-kolom sisanya yang masih absen
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable();
            }
            if (!Schema::hasColumn('users', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('users', 'skills')) {
                $table->string('skills')->nullable();
            }
            if (!Schema::hasColumn('users', 'major')) {
                $table->string('major')->nullable();
            }
            if (!Schema::hasColumn('users', 'batch')) {
                $table->string('batch')->nullable();
            }
            if (!Schema::hasColumn('users', 'faculty')) {
                $table->string('faculty')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'about_me', 'phone', 'location', 'birth_date', 
                'gender', 'skills', 'major', 'batch', 'faculty'
            ]);
        });
    }
};