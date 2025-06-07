<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /** @use HasFactory<\Database\Factories\CharacterFactory> */
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'status',
        'species',
        'type',
        'gender',
        'url',
    ];

    const FILTER_COLUMNS = [
        'name', 
        'status', 
        'species', 
        'type',
        'gender',
    ];

    /**
     * Filter characters by column.
     * 
     * @param Builder $query
     * @param string $column
     * @param string|null $term
     * @return Builder
     */
    public function scopeSearchBy(Builder $query, string $column, ?string $term): Builder
    {
        $term = strtolower(trim($term));

        return $query
            ->when($term && $term !== '', function ($query) use ($column, $term) {
                $query->whereRaw("(LOWER(characters.{$column}) LIKE ?)", ["%{$term}%"]);
            });
    }
}
