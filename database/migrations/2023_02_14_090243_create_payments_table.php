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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->float('subtotal')->default(0);
            $table->float('discount')->default(0);
            $table->float('admin_fee')->default(0);
            $table->float('total')->default(0);
            $table->string('reference')->nullable();
            $table->string('va_number')->nullable();
            $table->json('links')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('expire')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
