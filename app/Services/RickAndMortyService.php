<?php

namespace App\Services;

use GuzzleHttp\Client;

class RickAndMortyService
{
    protected $client;

    const BASE_URL = 'https://rickandmortyapi.com/api/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URL,
            'timeout'  => 5.0,
        ]);
    }

    /**
     * Fetch data.
     *
     * @param string $url
     * @param int $query
     * @return array<string, mixed>
     */
    private function getData(string $url, array $query = ['page' => 1])
    {
        try {
            $response = $this->client->get($url, [
                'query' => $query,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Fetch characters data.
     *
     * @param string $url
     * @param array $query
     * @return array<string, mixed>
     */
    public function getCharacters(array $query = ['page' => 1])
    {
        return $this->getData('character', $query);
    }
 }