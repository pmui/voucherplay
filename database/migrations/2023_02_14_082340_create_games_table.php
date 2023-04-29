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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('code',50)->unique();
            $table->string('title',200);
            $table->string('image_url',255)->nullable();
            $table->tinyText('description')->nullable();
            $table->tinyText('info')->nullable();
            $table->tinyText('tnc')->nullable();
            $table->set('type',['voucher','top-up'])->nullable();
            $table->json('validation_fields')->nullable();
            $table->boolean('trending')->default(false);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('games');
    }
};
