<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('price')->default(0);
            $table->string('total_price')->default(0);
            $table->dateTime('time')->nullable();
            $table->integer('status_car')->default(0);
            $table->integer('status_payment')->default(0);

            $table->bigInteger('traffic_id')->unsigned();
            $table->foreign('traffic_id')->references('id')->on('traffic')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
