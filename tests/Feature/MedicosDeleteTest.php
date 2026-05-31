<?php

namespace Tests\Feature;

use App\Models\Medicos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicosDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_removes_medico_and_redirects(): void
    {
        $medico = Medicos::factory()->create();

        $response = $this->delete(route('medicos.destroy', $medico->id));

        $response->assertRedirect(route('medicos.index'));
        $this->assertModelMissing($medico);
    }

    public function test_destroy_returns_404_for_nonexistent_id(): void
    {
        $response = $this->delete(route('medicos.destroy', 999));

        $response->assertNotFound();
    }

    public function test_destroy_with_post_method(): void
    {
        $medico = Medicos::factory()->create();

        $response = $this->post(route('medicos.destroy', $medico->id), ['_method' => 'DELETE']);

        $response->assertRedirect(route('medicos.index'));
        $this->assertModelMissing($medico);
    }
}
