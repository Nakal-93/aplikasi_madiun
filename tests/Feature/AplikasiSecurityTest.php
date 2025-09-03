<?php

namespace Tests\Feature;

use App\Models\Aplikasi;
use App\Models\Opd;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AplikasiSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_aplikasi_list()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_public_can_view_aplikasi_detail()
    {
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->get("/aplikasi/{$aplikasi->id}");
        $response->assertStatus(200);
    }

    public function test_public_can_create_aplikasi()
    {
        $response = $this->get('/aplikasi/create');
        $response->assertStatus(200);
    }

    public function test_public_cannot_edit_aplikasi()
    {
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->get("/admin/aplikasi/{$aplikasi->id}/edit");
        $response->assertRedirect('/admin/login');
    }

    public function test_public_cannot_update_aplikasi()
    {
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->put("/admin/aplikasi/{$aplikasi->id}", [
            'nama_aplikasi' => 'Test Update',
        ]);
        $response->assertRedirect('/admin/login');
    }

    public function test_public_cannot_delete_aplikasi()
    {
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->delete("/admin/aplikasi/{$aplikasi->id}");
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_edit_aplikasi()
    {
        $user = User::factory()->create();
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->actingAs($user)->get("/admin/aplikasi/{$aplikasi->id}/edit");
        $response->assertStatus(200);
    }

    public function test_admin_can_delete_aplikasi()
    {
        $user = User::factory()->create();
        $opd = Opd::factory()->create();
        $aplikasi = Aplikasi::factory()->create(['opd_id' => $opd->id]);

        $response = $this->actingAs($user)->delete("/admin/aplikasi/{$aplikasi->id}");
        $response->assertRedirect();
        
        $this->assertDatabaseMissing('aplikasis', ['id' => $aplikasi->id]);
    }
}
