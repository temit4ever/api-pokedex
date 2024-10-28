<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Pokemon extends Model
{
    use Timestamp;
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'image',
        'ability',
        'height',
        'weight',
    ];

    public function scopeGetPokemonByName(Builder $query): LengthAwarePaginator
    {
        return $query->where('name', 'LIKE', request('name') . '%')->paginate(15);
    }
}
