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
        Schema::table('projects', function (Blueprint $table) {
            // creo la colonna della foreign key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // assegno la foreign key alla colonna creata
            $table->foreign('type_id')
                    ->references('id')
                    ->on('types')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // elimino la foreign key
            $table->dropForeign(['type_id']);

            // elimino la colonna
            $table->dropColumn('type_id');
        });
    }
};
