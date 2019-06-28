<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('table_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_token');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestampsTz();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('table_user');
    }
}