<?php

namespace App\Models;

use App\Services\CardsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int column_id
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
    use HasFactory, SoftDeletes;

    protected $visible = ['id', 'position', 'title', 'description'];
    protected $fillable = ['title', 'description'];

    protected $casts = [
        'id' => 'int',
        'column_id' => 'int',
        'position' => 'int',
    ];

    protected static function boot()
    {
        parent::boot();

        //Fill up the "position" when adding a new card
        self::creating(static function (self $card) {
            $card->position = $card->column->cards()->count() + 1;
        });

        self::deleted(static function (self $card) {
            app(CardsService::class)->shiftPositionsBackwards($card->column_id, $card->position);
        });
    }

    public function column(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
