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
}
