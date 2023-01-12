<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Services\ColumnsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ColumnsController extends Controller
{
    public function __construct(
        private ColumnsService $columnsService
    )
    {
    }

    public function index(): Collection
    {
        return $this->columnsService->getAll();
    }

    public function create(Request $request): Column
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        return $this->columnsService->createNewColumn($request->title);
    }
}
