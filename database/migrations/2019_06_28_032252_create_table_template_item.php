<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTemplateItem extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('table_template_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->integer('urgency');
            $table->integer('due_interval');
            $table->string('due_unit');
            $table->integer('template_id');
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
        Schema::dropIfExists('table_template_item');
    }
}