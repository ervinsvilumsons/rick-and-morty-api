<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CharactersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testCharacters(): void
    {
        Character::factory()->count(20)->create();

        $this->get('/api/characters')
            ->assertJsonFragment(['current_page' => 1])
            ->assertJsonPath('meta.to', 15)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharactersSecondPage(): void
    {
        Character::factory()->count(20)->create();

        $this->get('/api/characters?page=2')
            ->assertJsonFragment(['current_page' => 2])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharactersPerPage(): void
    {
        Character::factory()->count(20)->create();

        $this->get('/api/characters?per_page=20')
            ->assertJsonFragment(['per_page' => 20])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharactersFilterName(): void
    {
        $data = ['name' => 'Alien'];
        Character::factory()->create($data);

        $this->get('/api/characters?name=alien')
            ->assertJsonFragment($data)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharactersFilterStatus(): void
    {
        $data = ['status' => 'unknown'];
        Character::factory()->create($data);

        $this->get('/api/characters?status=unknown')
            ->assertJsonFragment($data)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharacter(): void
    {
        $character = Character::factory()->create();

        $this->get('/api/characters/' . $character->id)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testCharacterNotFound(): void
    {
        $this->get('/api/characters/1')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
