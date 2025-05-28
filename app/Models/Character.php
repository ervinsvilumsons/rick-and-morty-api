<?php

namespace App\Models;

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

    /**
     * Filter characters by column.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string|null $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchBy(\Illuminate\Database\Eloquent\Builder $query, string $column, ?string $term): \Illuminate\Database\Eloquent\Builder
    {
        $allowedColumns = [
            'name', 
            'status', 
            'species', 
            'type',
            'gender',
        ];
        $term = strtolower(trim($term));

        if (!in_array($column, $allowedColumns)) {
            return $query;
        }

        return $query
            ->when($term && $term !== '', function ($query) use ($column, $term) {
                $query->whereRaw("(LOWER(characters.{$column}) LIKE ?)", ["%{$term}%"]);
            });
    }
}
