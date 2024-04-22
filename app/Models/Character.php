<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'enemy' => 'boolean',
            'defence' => 'integer',
            'strength' => 'integer',
            'accuracy' => 'integer',
            'magic' => 'integer',

        ];
    }
}
