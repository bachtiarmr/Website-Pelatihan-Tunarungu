<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_and_open_the_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'admin-password',
            'role' => 'admin',
        ]);

        $this->post(route('login.process'), [
            'email' => 'admin@example.com',
            'password' => 'admin-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Admin');
    }

    public function test_dashboard_menu_is_available_only_to_admins(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.menu', ['menu' => 'peserta']))
            ->assertOk()
            ->assertSee('Halaman Peserta');

        $this->actingAs($admin)
            ->get(route('admin.menu', ['menu' => 'invalid']))
            ->assertNotFound();

        $participant = User::factory()->create(['role' => 'peserta']);

        $this->actingAs($participant)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_registration_creates_a_participant_and_completes_without_debug_dump(): void
    {
        $this->post(route('register.process'), [
            'name' => 'Peserta Baru',
            'email' => 'peserta@example.com',
            'password' => 'participant-password',
            'password_confirmation' => 'participant-password',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'peserta@example.com',
            'role' => 'peserta',
        ]);
    }

    public function test_admin_seeder_creates_a_password_protected_admin(): void
    {
        config([
            'admin.name' => 'Administrator',
            'admin.email' => 'admin@example.com',
            'admin.password' => 'a-secure-password',
        ]);

        $this->seed(AdminUserSeeder::class);

        $admin = User::where('email', 'admin@example.com')->firstOrFail();

        $this->assertSame('admin', $admin->role);
        $this->assertTrue(Hash::check('a-secure-password', $admin->password));
    }
}
