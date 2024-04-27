<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contest extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'win',
        'history',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'win' => 'boolean'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function characters(): belongsToMany
    {
        return $this->belongsToMany(Character::class);
    }

    public function hero(): belongsToMany
    {
        return $this->belongsToMany(Character::class)->wherePivot('hero', 1)->withPivot('hero_hp');
    }

    public function enemy(): belongsToMany
    {
        return $this->belongsToMany(Character::class)->wherePivot('hero', 0)->withPivot('enemy_hp');
    }
}
