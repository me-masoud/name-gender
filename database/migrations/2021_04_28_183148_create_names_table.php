<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->string('firstChar' , '2')->nullable();
            $table->string('name');
            $table->string('enName');
            $table->enum('sex' , ['male' , 'female' , 'both'])->nullable();
            $table->enum('baseCulture' , ['iran' , 'arabic' , 'turkey'])->nullable();
            $table->longText('sameNames')->nullable();
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
        Schema::dropIfExists('names');
    }
}
