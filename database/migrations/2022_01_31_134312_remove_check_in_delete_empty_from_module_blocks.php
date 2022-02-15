<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCheckInDeleteEmptyFromModuleBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module_blocks', function (Blueprint $table) {
            $table -> dropColumn('check_in_delete_empty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_blocks', function (Blueprint $table) {
            $table -> integer('check_in_delete_empty') -> default(0);
        });
    }
}