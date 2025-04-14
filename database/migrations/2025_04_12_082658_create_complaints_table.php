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
        Schema::create('complaints', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->id('provinces_id');
            $table->id('regencis_id');
            $table->id('districts_id');
            $table->id('villages_id');
            $table->enum('name', ['kejahatan', 'pembangunan', 'sosial']);
            $table->enum('status', ['pending', 'proses', 'selesai', 'tolak'])->default('pending'); 
            $table->text('detail');
            $table->string('image_path')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('total_likes')->default(0);
            $table->integer('total_views')->default(0);
            $table->timestamps();
    
            $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('regencis_id')->references('id')->on('regencis')->onDelete('cascade');
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('villages_id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
