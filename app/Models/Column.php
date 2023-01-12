<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int position
 * @property ?string title
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property ?Carbon deleted_at
 *
 * @property Card[]|Collection $cards
 */
class Column extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'int',
        'position' => 'int',
    ];

    public function cards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Card::class)->orderBy('position');
    }
}
