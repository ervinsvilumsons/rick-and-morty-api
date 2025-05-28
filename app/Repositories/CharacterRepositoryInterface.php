<?php

namespace App\Repositories;

interface CharacterRepositoryInterface
{
    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}