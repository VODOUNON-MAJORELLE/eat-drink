<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Stand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Administrateur');
    }

    public function test_admin_can_see_pending_requests()
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        $entrepreneur = User::factory()->create([
            'role' => User::ROLE_ENTREPRENEUR_EN_ATTENTE,
            'statut' => User::STATUT_EN_ATTENTE,
        ]);

        $response = $this->actingAs($admin)->get('/admin/demandes');

        $response->assertStatus(200);
        $response->assertSee($entrepreneur->nom_entreprise);
    }

    public function test_admin_can_approve_request()
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        $entrepreneur = User::factory()->create([
            'role' => User::ROLE_ENTREPRENEUR_EN_ATTENTE,
            'statut' => User::STATUT_EN_ATTENTE,
        ]);

        $response = $this->actingAs($admin)->post("/admin/demandes/{$entrepreneur->id}/approuver");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $entrepreneur->id,
            'role' => User::ROLE_ENTREPRENEUR_APPROUVE,
            'statut' => User::STATUT_APPROUVE,
        ]);
    }

    public function test_admin_can_reject_request()
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'statut' => User::STATUT_APPROUVE,
        ]);

        $entrepreneur = User::factory()->create([
            'role' => User::ROLE_ENTREPRENEUR_EN_ATTENTE,
            'statut' => User::STATUT_EN_ATTENTE,
        ]);

        $response = $this->actingAs($admin)->post("/admin/demandes/{$entrepreneur->id}/rejeter", [
            'motif_rejet' => 'Test de rejet',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $entrepreneur->id,
            'statut' => User::STATUT_REJETE,
        ]);
    }

    public function test_non_admin_cannot_access_admin_pages()
    {
        $user = User::factory()->create([
            'role' => User::ROLE_ENTREPRENEUR_APPROUVE,
            'statut' => User::STATUT_APPROUVE,
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/dashboard');
    }
} 