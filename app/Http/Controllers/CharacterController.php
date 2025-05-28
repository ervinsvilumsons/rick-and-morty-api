<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Repositories\CharacterRepositoryInterface;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    protected $characterRepository;

    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CharacterResource::collection($this->characterRepository->all());
    }

    public function show(Character $character): CharacterResource
    {
        return new CharacterResource($character);
    }
}
