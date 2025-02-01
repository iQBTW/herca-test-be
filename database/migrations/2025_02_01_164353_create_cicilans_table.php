<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cicilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id');
            $table->integer('jumlah_per_cicilan');
            $table->integer('total_cicilan');
            $table->integer('sisa_cicilan');
            $table->enum('status', ['lunas', 'belum Lunas'])->default('belum Lunas');
            $table->date('date');
            $table->timestamps();

            $table->foreign('penjualan_id')->on('penjualans')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cicilans');
    }
};
