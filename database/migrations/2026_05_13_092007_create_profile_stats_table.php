<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_stats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')->constrained()->onDelete('cascade');

            $table->integer('projects')->default(0);
            $table->integer('clients')->default(0);
            $table->string('years')->nullable();
            $table->string('experience_years')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('profile_stats');
    }
};
