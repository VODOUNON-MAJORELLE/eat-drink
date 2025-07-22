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
            'name' => 'Admin Eat&Drink',
            'company_name' => 'Administration Eat&Drink',
            'email' => 'admin@eatanddrink.com',
            'password' => bcrypt('admin123'),
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        // Créer quelques entrepreneurs de test (optionnel)
        User::create([
            'name' => 'Jean Gourmet',
            'company_name' => 'Restaurant Le Gourmet',
            'email' => 'gourmet@test.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ENTREPRENEUR,
            'statut' => User::STATUT_EN_ATTENTE,
        ]);

        User::create([
            'name' => 'Marie Boulange',
            'company_name' => 'Boulangerie Artisanale',
            'email' => 'boulangerie@test.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ENTREPRENEUR,
            'statut' => User::STATUT_APPROUVE,
        ]);

        // Créer un deuxième administrateur de test
        User::create([
            'name' => 'Super Admin',
            'company_name' => 'Direction Eat&Drink',
            'email' => 'superadmin@eatanddrink.com',
            'password' => bcrypt('superadmin456'),
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);
        User::firstOrCreate(
            ['email' => 'nouveladmin@eatanddrink.com'],
            [
                'name' => 'Nom Admin',
                'company_name' => 'Administration Eat&Drink',
                'password' => bcrypt('motdepassefort'),
                'role' => User::ROLE_ADMIN,
                'statut' => User::STATUT_APPROUVE,
            ]
        );
    }
}
