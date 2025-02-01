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
        Schema::create('pembayaran_cicilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cicilan_id');
            $table->integer('jumlah_pembayaran');
            $table->date('date');
            $table->timestamps();

            $table->foreign('cicilan_id')->on('cicilans')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_cicilans');
    }
};
