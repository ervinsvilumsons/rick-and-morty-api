<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Builder;
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
        $queryParams = request()->query();

        return Character::when(!empty($queryParams), function (Builder $query) use ($queryParams) {
                foreach($queryParams as $key => $value) {
                    if (in_array($key, Character::FILTER_COLUMNS)) {
                        $query
                            ->searchBy($key, $value);
                    }
                }
            })
            ->paginate($perPage);
    }
}