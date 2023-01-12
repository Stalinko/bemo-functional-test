<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
use App\Services\CardsService;
use Illuminate\Database\Eloquent\Collection;
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
            'description' => 'nullable|string',
        ]);

        return $this->cardsService->updateCard($card, $request->all(['title', 'description']));
    }

    public function move(Request $request, Card $card): Card
    {
        $this->validate($request, [
            'column_id' => 'required|int|exists:columns,id',
            'position' => 'required|int|min:1',
        ]);

        return $this->cardsService->moveCard($card, $request->column_id, $request->position);
    }

    public function destroy(Card $card): array
    {
        $this->cardsService->destroy($card);
        return ['success' => true];
    }

    public function listCards(Request $request): Collection
    {
        $this->validate($request, [
            'date' => 'sometimes|date_format:Y-m-d',
            'status' => 'sometimes|in:0,1'
        ]);

        return $this->cardsService->listCards($request->date, $request->status);
    }
}
