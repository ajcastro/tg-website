<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberTransactionIdInMemberPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_promotions', function (Blueprint $table) {
            $table->foreignId('member_transaction_id')->nullable()->index()->after('promotion_id');
        });
    }
}
