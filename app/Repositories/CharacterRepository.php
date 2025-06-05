<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CharacterRepository implements CharacterRepositoryInterface
{
    /**
     * Get all characters.
     * 
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        $perPage = min((int) (request()->query('per_page')) ?? 15, 200);
        $name = request()->query('name');
        $status = request()->query('status');

        return Character::searchBy('name', $name)
            ->searchBy('status', $status)
            ->paginate($perPage);
    }
}