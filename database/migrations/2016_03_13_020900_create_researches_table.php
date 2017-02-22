<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create('researches', function(Blueprint $table) {
	$table->increments('id');
	$table->timestamps();
	$table->string('type');
  $table->string('track')->nullable();
	$table->string('title');
	$table->text('research');
	$table->text('abstract');
	$table->integer('auth_count');
	$table->text('first0')->nullable();
	$table->text('last0')->nullable();
  $table->text('first1')->nullable();
	$table->text('last1')->nullable();
  $table->text('first2')->nullable();
	$table->text('last2')->nullable();
  $table->text('first3')->nullable();
	$table->text('last3')->nullable();
  $table->text('first4')->nullable();
	$table->text('last4')->nullable();

	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
	       Schema::dropIfExists('researches');
    }
}
