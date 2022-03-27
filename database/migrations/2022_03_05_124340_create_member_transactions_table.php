<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->string('type')->index()->comment('transaction type:deposit,withdraw');
            $table->boolean('is_adjustment')->default(0);
            $table->string('account_code')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('company_bank')->nullable();
            $table->decimal('company_bank_factor', 5, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('credit_amount', 15, 2)->default(0);
            $table->decimal('debit_amount', 15, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->default(0)->index()->comment('0=new transaction, 1=approved, 2=reject, 3=in progress');
            $table->string('member_ip')->nullable();
            $table->string('member_info')->nullable();
            $table->string('screenshot_name')->nullable();
            $table->string('screenshot_path')->nullable();
            $table->unsignedBigInteger('approved_by_id')->index()->nullable();
            $table->timestamp('approved_at')->index()->nullable();
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
        Schema::dropIfExists('member_transactions');
    }
}
