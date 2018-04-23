<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic');
            $table->longText('description');
            $table->dateTime('close_at')->nullable();
            $table->integer('state')->default(0);
            $table->integer('source_id')->default(1);
            $table->integer('technician_id')->nullable();
            $table->integer('importance')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('society_id')->unsigned();
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
        Schema::dropIfExists('tickets');
    }
}
