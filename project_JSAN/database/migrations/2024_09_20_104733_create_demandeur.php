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
        Schema::create('demandeur', function (Blueprint $table) {
            $table->id();
            $table->integer('etat')->default(0);
            $table->string('Nom');
            $table->string('Lieu_de_Naissance');
            $table->date('Date_de_Naissance');
            $table->string('Pere');
            $table->string('Mere');
            $table->string('Adresse');
            $table->string('Telephone');
            $table->integer('usertpi');
            $table->timestamps();
            $table->foreign('usertpi')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeur');
    }
};