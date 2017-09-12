<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('t_id');
            $table->integer('user_id');
            $table->dateTime('start_date');
            $table->integer('amount');
            $table->string('month_used');
            $table->integer('profit_acc');
            $table->integer('total_inv');
            $table->boolean('active');
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
        Schema::dropIfExists('trade_trans');
    }
}
