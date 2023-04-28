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
            $table->ulid('id')->primary();
            $table->text('claim')->nullable();
            $table->dateTime('delivery_date');
            $table->decimal('total');
            $table->decimal('iva')->nullable();
            $table->string('address');
            $table->foreignId('state_id')
                ->constrained('states');
            $table->string('user_id');
            $table->foreign('user_id')->references('cc')->on('users');
            $table->string('delivery_id');
            $table->foreign('delivery_id')->references('cc')->on('users');
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
