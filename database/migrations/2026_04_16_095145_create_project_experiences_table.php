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
        Schema::create('project_experiences', function (Blueprint $table) {
            $table->id();

            $table->string('project_name');
            $table->string('language');
            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->enum('project_type', [
                'Frontend',
                'Backend',
                'Fullstack',
                'UI/UX'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_experiences');
    }
};
