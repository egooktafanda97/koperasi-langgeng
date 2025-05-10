<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategori_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit', 100);
            $table->foreignId('kategori_usaha_id')->nullable()->constrained('kategori_usaha')->onDelete('set null');
            $table->string('penanggung_jawab', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });



        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'unit']);
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('produk_unit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->string('nama_produk', 100);
            $table->enum('jenis_produk', ['barang', 'jasa']);
            $table->string('satuan', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->string('bulan', 10);
            $table->string('file_laporan', 255)->nullable();
            $table->bigInteger('pendapatan')->default(0);
            $table->bigInteger('pengeluaran')->default(0);
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->string('keterangan')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        Schema::create('komentar_laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->text('isi_komentar');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->text('isi');
            $table->string('file_lampiran', 255)->nullable();
            $table->boolean('tampilkan')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('aktivitas');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('total_unit')->default(0);
            $table->integer('total_laporan')->default(0);
            $table->bigInteger('total_pendapatan')->default(0);
            $table->bigInteger('total_pengeluaran')->default(0);
            // total_keuntungan bisa dihitung di controller atau pakai view database
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi');
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('pengumuman');
        Schema::dropIfExists('komentar_laporan');
        Schema::dropIfExists('laporan');
        Schema::dropIfExists('produk_unit');
        Schema::dropIfExists('users');
        Schema::dropIfExists('kategori_usaha');
        Schema::dropIfExists('units');
    }
};
