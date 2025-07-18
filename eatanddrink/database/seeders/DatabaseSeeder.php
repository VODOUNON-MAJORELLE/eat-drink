<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer l'administrateur par défaut
        User::create([
            'nom_entreprise' => 'Administration Eat&Drink',
            'email' => 'admin@eatanddrink.com',
            'password' => bcrypt('admin123'),
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        // Créer quelques entrepreneurs de test (optionnel)
        User::create([
            'nom_entreprise' => 'Restaurant Le Gourmet',
            'email' => 'gourmet@test.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ENTREPRENEUR_EN_ATTENTE,
            'statut' => User::STATUT_EN_ATTENTE,
        ]);

        User::create([
            'nom_entreprise' => 'Boulangerie Artisanale',
            'email' => 'boulangerie@test.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ENTREPRENEUR_APPROUVE,
            'statut' => User::STATUT_APPROUVE,
        ]);
    }
}
