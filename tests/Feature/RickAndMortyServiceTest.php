<?php

namespace Tests\Feature;

use App\Services\RickAndMortyService;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use Tests\TestCase;

class RickAndMortyServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testRickAndMortyApiCharacters(): void
    {
        $client = new RickAndMortyService();
        $response = $client->getCharacters();
            
        $this->assertNotEmpty($response['results']);
    }

    /**
     * @return void
     */
    public function testRickAndMortyApiException(): void
    {
        $errorMessage = 'Internal Server Error';
        $mock = new MockHandler([
            new RequestException($errorMessage, new Request('GET', RickAndMortyService::BASE_URL)),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new RickAndMortyService(['handler' => $handlerStack]);
        $response = $client->getCharacters();

        $this->assertArrayHasKey('error', $response);
        $this->assertStringContainsString($errorMessage, $response['error']);
    }
}
