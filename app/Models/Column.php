<?php

namespace App\Models;

use App\Services\ColumnsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use HasFactory, SoftDeletes;

    protected $visible = ['id', 'position', 'title', 'cards'];
    protected $fillable = ['title'];

    protected $casts = [
        'id' => 'int',
        'position' => 'int',
    ];

    protected static function boot()
    {
        parent::boot();

        //Fill up the "position" when adding a new column
        self::creating(static function (self $column) {
            $column->position = self::count() + 1;
        });

        self::deleted(static function (self $column) {
            app(ColumnsService::class)->shiftPositionsBackwards($column->position);

            //we need to soft-delete all nested cards
            $column->cards()->delete();
        });
    }

    public function cards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Card::class)->orderBy('position');
    }
}
