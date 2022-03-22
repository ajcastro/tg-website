<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSequenceInMemberTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('sequence')->default(0)->after('type');
        });
    }
}
