<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('demandeur', function (Blueprint $table) {
            // Ajout de la colonne userTpi avec l'ID de l'utilisateur actuel par défaut
            $table->integer('userTpi')->default(Auth::id());

            // Définition de la clé étrangère sur userTpi (référence à la table users)
            $table->foreign('userTpi')->references('id')->on('users')->onDelete('cascade');
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
