<?php

namespace CupNoodles\InstaGallery\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Schema;

/**
 * 
 */
class AddInstaAccounts extends Migration
{
     /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->text('access_token');
            $table->integer('cache_num');
            $table->nullableTimestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('instagram_accounts');
    }

}
