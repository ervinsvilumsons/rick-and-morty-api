<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharactersTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_characters(): void
    {
        Character::factory()->count(20)->create();

        $this->get('/api/characters')
            ->assertJsonPath('meta.to', 15)
            ->assertStatus(200);
    }

    public function test_the_application_returns_filter_name(): void
    {
        $data = ['name' => 'Alien'];
        Character::factory()->create($data);

        $this->get('/api/characters?name=alien')
            ->assertJsonFragment($data)
            ->assertStatus(200);
    }

    public function test_the_application_returns_filter_status(): void
    {
        $data = ['status' => 'unknown'];
        Character::factory()->create($data);

        $this->get('/api/characters?status=unknown')
            ->assertJsonFragment($data)
            ->assertStatus(200);
    }

    public function test_the_application_returns_character(): void
    {
        $character = Character::factory()->create();

        $this->get('/api/characters/' . $character->id)
            ->assertStatus(200);
    }

    public function test_the_application_returns_character_not_found(): void
    {
        $this->get('/api/characters/1')
            ->assertStatus(404);
    }
}
