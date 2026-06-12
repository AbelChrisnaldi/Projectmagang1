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
        if (Schema::hasTable('dosen_riib')) {
            return;
        }

        Schema::create('dosen_riib', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_dosen', 10)->nullable();
            $table->string('nama_dosen', 150)->nullable();
            $table->string('prodi', 100)->nullable();
            $table->string('kk', 10)->nullable();
            $table->enum('jad', ['NJFA', 'AA', 'L', 'LK', 'GB'])->nullable();
            $table->string('sub_kk', 10)->nullable();
            $table->string('pendidikan_terakhir', 10)->nullable();
            $table->integer('tahun_masuk')->nullable();
            $table->boolean('sedang_studi_lanjut')->nullable()->default(false);
            $table->string('nidn', 20)->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('CoE', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_riib');
    }
};
