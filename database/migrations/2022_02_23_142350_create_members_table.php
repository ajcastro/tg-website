<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('website_id')->index();
            $table->unsignedBigInteger('upline_referral_id')->nullable()->index();
            $table->string('referral_number')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('phone_number');
            $table->tinyInteger('member_level')->default(0);
            $table->string('bank_group');
            $table->decimal('balance_amount', 15, 2)->default(0);
            $table->decimal('balance_credit', 15, 2)->default(0);
            $table->tinyInteger('warning_status')->default(0)->index();
            $table->string('warning_notes')->nullable();
            $table->integer('redeem_point')->nullable();
            $table->decimal('total_deposit', 15, 2)->default(0);
            $table->decimal('total_withdrawal', 15, 2)->default(0);
            $table->string('rebate_group')->nullable();
            $table->timestamp('login_time')->index()->nullable();
            $table->timestamp('logout_time')->index()->nullable();
            $table->timestamp('suspended_at')->index()->nullable();
            $table->unsignedBigInteger('suspended_by_id')->index()->nullable();
            $table->text('suspended_reason')->nullable();
            $table->timestamp('blacklisted_at')->index()->nullable();
            $table->unsignedBigInteger('blacklisted_by_id')->index()->nullable();
            $table->text('blacklisted_reason')->nullable();
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
        Schema::dropIfExists('members');
    }
}
