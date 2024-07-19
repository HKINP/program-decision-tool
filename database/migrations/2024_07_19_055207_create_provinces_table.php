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
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
