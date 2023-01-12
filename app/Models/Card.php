<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int position
 * @property ?string title
 * @property ?string description
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property ?Carbon deleted_at
 *
 * @property Column $column
 */
class Card extends Model
{
    use HasFactory;

    protected $visible = ['id', 'position', 'title', 'description'];

    protected $casts = [
        'id' => 'int',
        'position' => 'int',
    ];

    public function column(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
