<?php

namespace CupNoodles\InstaGallery\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Schema;

/**
 * 
 */
class AddInstaMedia extends Migration
{
     /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('instagram_media', function (Blueprint $table) {
            $table->string('media_id');
            $table->integer('account_id');
            $table->string('media_type');
            $table->text('caption');
            $table->text('media_url');
            $table->string('permalink');
            $table->nullableTimestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('instagram_media');
    }

}
