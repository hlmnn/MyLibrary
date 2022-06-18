<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circulations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi',6)->unique();
            $table->foreignId('member_id')->constrained('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('koleksi_id')->constrained('collections')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->integer('durasi');
            $table->date('tgl_kembali')->nullable();
            $table->string('status')->default('Sedang Dipinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('circulations');
    }
};
