<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeStep1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_step_1', function (Blueprint $table) {
            $table->id();
            $table->integer('top_level');
            $table->string('title_ge')->default('');
            $table->string('title_en')->default('');
            $table->text('text_ge')->nullable();
            $table->text('text_en')->nullable();
			$table->integer('rang')->default(0);
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
        Schema::dropIfExists('home_step_1');
    }
}
