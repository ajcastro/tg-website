<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveAndRoleIdInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('remember_token', function (Blueprint $table) {
                $table->foreignId('role_id')->index();
                $table->boolean('is_active')->default(1)->index();
                $table->foreignId('created_by_id')->index();
                $table->foreignId('updated_by_id')->index();
            });
        });
    }
}
