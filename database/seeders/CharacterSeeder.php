<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Services\RickAndMortyService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (\DB::table('characters')->count() === 0) {
            $client = new RickAndMortyService();
            $response = $client->getCharacters();
            $lastPage = $response['info']['pages'];

            for ($currentPage = 1; $currentPage <= $lastPage; $currentPage++) {
                $response = $client->getCharacters(['page' => $currentPage]);

                foreach($response['results'] as $character) {
                    
                    Character::factory()->create([
                        'id' => $character['id'],
                        'name' => $character['name'],
                        'status' => $character['status'],
                        'species' => $character['species'],
                        'type' => $character['type'],
                        'gender' => $character['gender'],
                        'url' => app()->url->to('api/characters/' . $character['id']),
                    ]);
                }
            }
        }
    }
}
