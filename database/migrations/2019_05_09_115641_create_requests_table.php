<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->unsignedInteger('user_id');
            $table->float('amount')->nullable();
            $table->string('description')->nullable();
            $table->string('currency', 3)->default('eur');
            $table->string('bank_iban')->nullable();
            $table->boolean('active')->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bank_iban')->references('iban')->on('bank_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
