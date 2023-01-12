<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Column;

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

    public function updateCard(Card $card, string $title): Card
    {
        $card->title = $title;
        $card->save();

        return $card;
    }

    public function destroy(Card $card): void
    {
        $card->delete();
    }

    public function shiftPositionsAfter(int $position): void
    {
        Card::where('position', '>', $position)->update(['position' => \DB::raw('position - 1')]);
    }
}
