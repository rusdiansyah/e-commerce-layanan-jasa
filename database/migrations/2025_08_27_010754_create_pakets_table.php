<?php

use App\Models\JenisPaket;
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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JenisPaket::class)->constrained();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('lama');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('harga');
            $table->string('gambar');
            $table->smallInteger('max_orang');
            $table->boolean('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
