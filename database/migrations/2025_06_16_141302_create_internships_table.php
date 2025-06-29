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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('posisi_magang');
            $table->text('deskripsi_pekerjaan');
            $table->text('kualifikasi');
            $table->string('durasi_magang');
            $table->enum('lokasi_magang', ['onsite', 'remote', 'hybrid']);
            $table->text('benefit')->nullable();
            $table->date('deadline_pendaftaran');
            $table->text('cara_melamar');
            $table->string('kontak_email');
            $table->string('kontak_telepon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by'); // ID user yang membuat
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};