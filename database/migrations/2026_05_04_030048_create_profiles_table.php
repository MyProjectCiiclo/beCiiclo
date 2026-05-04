<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->integer('projects')->default(0);
            $table->string('years')->nullable();
            $table->integer('clients')->default(0);

            $table->string('experience_years')->nullable();
            $table->string('degree')->nullable();

            $table->string('website')->nullable();
            $table->string('email')->nullable();

            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('avatar')->nullable();
            $table->string('cv_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};