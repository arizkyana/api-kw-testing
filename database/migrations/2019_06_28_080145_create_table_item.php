<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItem extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('table_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('checklist_id');
            $table->text('description');
            $table->boolean('is_completed')->default(false);
            $table->dateTimeTz('completed_at')->nullable();
            $table->dateTimeTz('due')->nullable();
            $table->integer('urgency')->nullable();
            $table->double('updated_by')->nullable();
            $table->double('assignee_id')->nullable();
            $table->double('task_id')->nullable();
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
        Schema::dropIfExists('table_item');
    }
}