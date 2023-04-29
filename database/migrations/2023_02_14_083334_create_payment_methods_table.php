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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->set('category',['Bank Transfer','QRIS','E-Wallet','Store']);
            $table->string('code')->unique();
            $table->string('name');
            $table->string('image_url');
            $table->integer('min_amount')->default(0);
            $table->float('fee_amount')->default(0);
            $table->float('fee_percent')->default(0);
            $table->boolean('active')->default(true);
            $table->tinyText('note')->nullable();
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
        Schema::dropIfExists('payment_methods');
    }
};
