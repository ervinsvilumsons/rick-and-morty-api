<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CharacterRepositoryInterface
{
    public function all(): LengthAwarePaginator;
}