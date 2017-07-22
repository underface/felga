<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
           $table->increments('id')->unsign()->index();
           $table->integer('customer_id')->unsign();
           $table->integer('user_id')->unsign();
           $table->integer('notification');
           $table->date('notification_date')->nullable();
           $table->string('title', 100);
           $table->text('content');
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
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
}
