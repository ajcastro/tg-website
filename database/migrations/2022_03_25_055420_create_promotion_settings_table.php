<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promotion_id');
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_thru')->nullable();
            $table->string('given_method');
            $table->boolean('is_for_new_member_only')->default(0);
            $table->unsignedTinyInteger('promotion_type');
            $table->unsignedInteger('allowed_n_times');
            $table->unsignedTinyInteger('calculation_type');
            $table->unsignedInteger('calculation_fix_amount')->default(0);
            $table->decimal('calculation_rate', 3, 2)->default(0);
            $table->unsignedInteger('turn_over_obligation')->default(1);
            $table->boolean('is_include_bonus_to_calculate_obligation')->default(0);
            $table->decimal('min_deposit', 15, 2)->default(0);
            $table->unsignedInteger('max_given_count')->default(0);
            $table->decimal('max_given_amount', 15, 2)->default(0);
            $table->boolean('is_auto_release')->default(1);
            $table->boolean('is_lock_withdrawal')->default(1);
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
        Schema::dropIfExists('promotion_settings');
    }
}
