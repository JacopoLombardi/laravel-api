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
        Schema::create('project_technology', function (Blueprint $table) {
            // colonna di relazione con Project
            $table->unsignedBigInteger('project_id');
            // foreign su questa colonna
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete();

                
            // colonna di relazione con Technology
            $table->unsignedBigInteger('technology_id');
            // foreign su questa colonna
            $table->foreign('technology_id')
                ->references('id')
                ->on('technologies')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
