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
            $table->string('name')->nullable();
            $table->string('persian_pronounce')->nullable();
            $table->string('en_name')->nullable();
            $table->string('en_pronounce')->nullable();
            $table->enum('gender' , ['male' , 'female' , 'both'])->nullable();
            $table->string('nationality')->nullable();
            $table->longText('description')->nullable();
            $table->string('abjad')->nullable();
            $table->string('popularity')->nullable();
            $table->string('confirm')->nullable();
            $table->softDeletes();
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
