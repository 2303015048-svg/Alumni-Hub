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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
        $table->string('title', 150); // Judul Posisi
        $table->string('company', 150); // Perusahaan
        $table->string('job_type'); // Full Time, Part Time, Remote, dll
        $table->string('category'); // Bidang Pekerjaan
        $table->string('location', 150); // Lokasi
        $table->string('salary_range')->nullable(); // Kisaran Gaji
        $table->date('deadline_date')->nullable(); // Batas Tanggal Lamaran
        $table->string('apply_link')->nullable(); // Link Lamaran
        $table->text('description');
        
        // Relasi Foreign Key ke tabel users
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        
        $table->timestamps();
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
