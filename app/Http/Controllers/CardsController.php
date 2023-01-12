<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
use App\Services\CardsService;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function __construct(
        private CardsService $cardsService
    )
    {
    }

    public function create(Request $request, Column $column): Card
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        return $this->cardsService->createNewCard($column, $request->title);
    }

    public function update(Request $request, Card $card): Card
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        return $this->cardsService->updateCard($card, $request->title);
    }
}
