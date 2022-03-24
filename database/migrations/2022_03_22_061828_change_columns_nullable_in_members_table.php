<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsNullableInMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('referral_number')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('bank_group')->nullable()->change();
        });
    }
}
