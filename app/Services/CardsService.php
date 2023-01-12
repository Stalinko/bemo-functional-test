<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Eloquent\Collection;

class CardsService
{
    /**
     * @param Column $column
     * @param string $title
     * @return Card
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function createNewCard(Column $column, string $title): Card
    {
        return $column->cards()->create(['title' => $title]);
    }

    public function updateCard(Card $card, array $data): Card
    {
        $card->update($data);

        return $card;
    }

    public function moveCard(Card $card, int $column_id, int $position): Card
    {
        \DB::transaction(function () use ($card, $column_id, $position) {
            $this->shiftPositionsForward($column_id, $position);

            $card->column_id = $column_id;
            $card->position = $position;
            $card->save();
        });

        return $card;
    }

    public function destroy(Card $card): void
    {
        $card->delete();
    }

    public function shiftPositionsBackwards(int $column_id, int $position): void
    {
        Card::where('position', '>', $position)
            ->where('column_id', $column_id)
            ->update(['position' => \DB::raw('position - 1')]);
    }

    public function shiftPositionsForward(int $column_id, int $position): void
    {
        Card::where('position', '>=', $position)
            ->where('column_id', $column_id)
            ->update(['position' => \DB::raw('position + 1')]);
    }

    /**
     * @param string|null $date
     * @param int|null    $status
     * @return Collection
     * @noinspection StaticInvocationViaThisInspection
     */
    public function listCards(?string $date, ?int $status): Collection
    {
        $query = Card::query();

        if ($date) {
            $query = $query->whereDate('created_at', $date);
        }
        if ($status === 0) {
            $query = $query->onlyTrashed();
        } elseif (is_null($status)) {
            $query = $query->withTrashed();
        }

        return $query->get()->makeVisible(['created_at', 'deleted_at']);
    }
}
