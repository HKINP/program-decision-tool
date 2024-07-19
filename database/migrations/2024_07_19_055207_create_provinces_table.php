<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province');
            $table->integer('updated_by')->unsigned()->default(null);
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('users');

        });
    }

    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
