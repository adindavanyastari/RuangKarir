<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // TAMBAH INI
            $table->string('foto')->default('icon');
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('fakultas');
            $table->integer('semester');
            $table->text('ringkasan_pribadi')->nullable();
            $table->string('email');
            $table->text('organisasi_dan_kepanitiaan')->nullable();
            $table->text('proyek')->nullable();
            $table->text('soft_skills')->nullable();
            $table->text('hard_skills')->nullable();
            $table->text('sertifikat')->nullable();
            $table->text('penghargaan')->nullable();
            $table->text('minat_karier')->nullable();
            $table->text('portofolio')->nullable();
            $table->timestamps();
            
            // TAMBAH FOREIGN KEY
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}