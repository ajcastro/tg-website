<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameMarketsTable extends Migration
{
    protected $connection = 'game4d';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_markets', function (Blueprint $table) {
            $table->id();
            $table->string('market_code')->index();
            $table->date('market_period')->index();
            $table->unsignedInteger('period')->comment('running number for period');
            $table->timestamp('close_time')->index();
            $table->timestamp('result_time')->index();
            $table->string('market_result')->nullable()->comment('this is null at first because game_market is still not closed, but when it closed there will be result');
            $table->unsignedTinyInteger('result_day')->comment('dayOfWeek in integer format base from market_period');
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
        Schema::dropIfExists('game_markets');
    }
}
