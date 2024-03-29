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
            // gallery-qol-additions
            $table->boolean('active');
            $table->string('display_title');
            $table->string('display_caption');
            $table->string('url');
            
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
