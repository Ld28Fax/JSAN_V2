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
        Schema::table('demandeur', function (Blueprint $table) {
            $table->integer('etat')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demandeur', function (Blueprint $table) {
            //
        });
    }
};

// $table->foreign('userTpi')->references('id')->on('users')->onDelete('cascade');
