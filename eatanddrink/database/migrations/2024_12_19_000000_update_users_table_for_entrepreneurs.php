<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Renommer nom_entreprise en company_name et ajouter name
            $table->renameColumn('nom_entreprise', 'company_name');
            $table->string('name')->after('id');
            
            // Ajouter les nouveaux champs d'entrepreneur
            $table->string('phone')->nullable()->after('email');
            $table->string('activity_type')->nullable()->after('phone');
            $table->text('specialties')->nullable()->after('activity_type');
            $table->text('description')->nullable()->after('specialties');
            $table->text('experience')->nullable()->after('description');
            
            // Mettre à jour les rôles
            $table->enum('role', ['admin', 'entrepreneur', 'participant'])->default('entrepreneur')->change();
            
            // Supprimer le champ statut (géré par la table stands)
            // $table->dropColumn('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Restaurer les champs originaux
            $table->renameColumn('company_name', 'nom_entreprise');
            $table->dropColumn(['name', 'phone', 'activity_type', 'specialties', 'description', 'experience']);
            $table->enum('role', ['admin', 'entrepreneur_en_attente', 'entrepreneur_approuve'])->default('entrepreneur_en_attente')->change();
            $table->enum('statut', ['en_attente', 'approuve', 'rejete'])->default('en_attente');
        });
    }
}; 
 
 