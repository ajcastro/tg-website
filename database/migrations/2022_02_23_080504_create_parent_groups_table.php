<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->index();
            $table->string('code')->unique();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('updated_by_id');
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
        Schema::dropIfExists('parent_groups');
    }
}
