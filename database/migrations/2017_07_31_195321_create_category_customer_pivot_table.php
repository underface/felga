<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryCustomerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
     {
         Schema::create('category_customer', function (Blueprint $table) {
            $table->integer('customer_id');
 		  $table->integer('category_id');
 		  $table->primary(['customer_id','category_id']);
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('category_customer', function (Blueprint $table) {
             //
         });
     }
}
