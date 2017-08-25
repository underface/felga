<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('messages', function (Blueprint $table) {
          $table->increments('id')->unsign();
          $table->char('status', 8);
          $table->string('sms_id');
          $table->integer('user_id')->unsigned();
          $table->integer('note_id')->unsigned();
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
      Schema::table('messages', function (Blueprint $table) {
           //
      });
    }
}
