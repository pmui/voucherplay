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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('product_code')->index();
            $table->string('game_code')->index();
            $table->string('voucher_code')->nullable();
            $table->string('reference')->nullable();
            $table->set('status',['waiting payment','paid','success','failed'])->nullable();
            $table->json('validation_fields')->nullable();
            $table->text('response')->nullable();
            $table->float('price');
            $table->float('cost')->default(0);
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
        Schema::dropIfExists('orders');
    }
};
