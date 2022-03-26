<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->string('bank_type');
            $table->string('bank_code');
            $table->string('bank_acc_no');
            $table->string('bank_acc_name');
            $table->boolean('is_active');
            $table->boolean('is_auto_update_balance');
            $table->decimal('bank_factor', 5, 2)->default(0);
            $table->unsignedInteger('min_amount')->nullable();
            $table->unsignedInteger('max_amount')->nullable();
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
        Schema::dropIfExists('company_banks');
    }
}
