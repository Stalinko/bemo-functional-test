<?php

namespace App\Services;

use App\Models\Column;
use Illuminate\Database\Eloquent\Collection;

class ColumnsService
{
    public function getAll(): Collection
    {
        return Column::orderBy('position')->with('cards')->get();
    }

    public function createNewColumn(string $title): Column
    {
        return Column::create(['title' => $title]);
    }

    public function updateColumn(Column $column, string $title): Column
    {
        $column->title = $title;
        $column->save();

        return $column;
    }
}
