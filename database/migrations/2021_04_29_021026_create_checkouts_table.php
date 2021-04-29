<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->dateTime('datetime');
            $table->bigInteger('price');
            $table->string('seller');
            $table->string('payment_method');
            $table->dateTime('datetime_check_back')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();

            $table->foreign('vehicle_id')
                ->references('id')
                ->on('vehicles');

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
        Schema::dropIfExists('checkouts');
    }
}
