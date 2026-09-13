<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles_cannot_open_another_roles_dashboard(): void
    {
        $this->actingAs(User::factory()->client()->create())
            ->get('/dashboard/admin')
            ->assertForbidden();

        $this->actingAs(User::factory()->student()->create())
            ->get('/dashboard/client')
            ->assertForbidden();

        $this->actingAs(User::factory()->admin()->create())
            ->get('/dashboard/student')
            ->assertForbidden();
    }

    public function test_each_role_can_open_its_own_dashboard(): void
    {
        $this->actingAs(User::factory()->admin()->create())
            ->get('/dashboard/admin')
            ->assertOk();

        $this->actingAs(User::factory()->client()->create())
            ->get('/dashboard/client')
            ->assertOk();

        $this->actingAs(User::factory()->student()->create())
            ->get('/dashboard/student')
            ->assertOk();
    }
}
