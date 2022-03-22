<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigned_client_id')->index();
            $table->string('code')->unique();
            $table->string('ip_address');
            $table->string('domain_name');
            $table->string('remarks')->nullable();
            $table->boolean('is_active')->default(0);
            $table->foreignId('created_by_id')->index();
            $table->foreignId('updated_by_id')->index();
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
        Schema::dropIfExists('websites');
    }
}
