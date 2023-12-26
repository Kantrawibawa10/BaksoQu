<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->string('id_produk');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->double('harga_produk');
            $table->integer('id_users');
            $table->string('nama_pelanggan');
            $table->string('user_acc');
            $table->dateTime('tgl_transaksi');
            $table->dateTime('close_transaksi');
            $table->enum('status', ['pending', 'proses', 'selesai']);
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
        Schema::dropIfExists('transactions');
    }
}
