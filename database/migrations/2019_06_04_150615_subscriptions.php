<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('request_id');
            $table->unsignedInteger('user_id');
            $table->string('mollie_subscription_id');

            $table->float('interval');
            $table->float('payments');
            $table->float('amount')->nullable();

            $table->string('state');

            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('requests');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
