<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChecklist extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('table_checklist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object_domain');
            $table->integer('object_id');
            $table->text('description');
            $table->boolean('is_completed')->default(false);
            $table->dateTimeTz('due');
            $table->integer('urgency')->default(0);
            $table->dateTimeTz('completed_at')->nullable();
            $table->double('updated_by')->nullable();
            $table->double('created_by');
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
        Schema::dropIfExists('table_checklist');
    }
}