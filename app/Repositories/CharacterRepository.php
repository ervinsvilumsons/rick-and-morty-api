<?php

namespace App\Repositories;

use App\Models\Character;

class CharacterRepository implements CharacterRepositoryInterface
{
    /**
     * Get all characters.
     */
    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $perPage = min((int) (request()->query('per_page')) ?? 15, 200);
        $name = request()->query('name');
        $status = request()->query('status');

        return Character::searchBy('name', $name)
            ->searchBy('status', $status)
            ->paginate($perPage);
    }
}