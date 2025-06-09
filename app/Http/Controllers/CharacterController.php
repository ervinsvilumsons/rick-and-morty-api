<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Repositories\CharacterRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CharacterController extends Controller
{
    protected $characterRepository;

    /**
     * @return void
     */
    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CharacterResource::collection($this->characterRepository->all());
    }

    /**
     * @param Character $character
     * @return CharacterResource
     */
    public function show(Character $character): CharacterResource
    {
        return new CharacterResource($character);
    }
}
