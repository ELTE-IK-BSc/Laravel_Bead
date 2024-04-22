<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Character_Contest extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hero_hp',
        'enemy_hp',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hero_hp' => 'float',
            'enemy_hp' => 'float',
        ];
    }
}
