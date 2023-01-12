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

    public function destroy(Column $column): void
    {
        if ($column->cards()->exists()) {
            //soft-delete
            $column->delete();
        } else {
            $column->forceDelete();
        }
    }

    public function shiftPositionsBackwards(int $position): void
    {
        Column::where('position', '>', $position)->update(['position' => \DB::raw('position - 1')]);
    }
}
