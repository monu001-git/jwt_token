<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('contents', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->string('alt')->nullable();
        //     $table->string('file')->nullable();
        //     $table->string('contenttitle')->nullable();
        //     $table->text('conenttext')->nullable();
        //     $table->string('contentimage')->nullable();
        //     $table->string('video_text')->nullable();
        //     $table->string('video_alt')->nullable();
        //     $table->string('url')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('status')->default(0);
            $table->string('order')->nullable();
            $table->string('image');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
