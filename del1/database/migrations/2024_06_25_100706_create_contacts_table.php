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
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('type_contact');
                $table->string('nom')->nullable();
                $table->string('prenom')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('etablissement')->nullable();
                $table->text('texte')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('contacts');
        }
};
