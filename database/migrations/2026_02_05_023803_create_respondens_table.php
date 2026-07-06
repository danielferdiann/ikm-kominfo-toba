<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('respondens', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            
            $table->string('layanan');

            $table->string('jenis_kelamin')->nullable();
            $table->string('usia')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            
            $table->integer('u1');
            $table->integer('u2');
            $table->integer('u3');
            $table->integer('u4');
            $table->integer('u5');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('respondens');
    }
};