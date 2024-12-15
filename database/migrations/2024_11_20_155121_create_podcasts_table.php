<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('host');
            $table->string('photo'); // Duration in minutes
            $table->string('category')->enum('video', 'audio', 'podcast'); // Duration in minutes
            $table->date('release_date');
            $table->string('audio_url'); // Link to the podcast audio file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('podcasts');
    }
}
