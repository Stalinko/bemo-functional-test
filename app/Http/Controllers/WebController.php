<?php

namespace App\Http\Controllers;

use App\Services\ExportDbService;

class WebController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('welcome');
    }

    public function exportSQL(ExportDbService $exportDbService)
    {
        $tmpFile = $exportDbService->exportDB();
        return response()->download($tmpFile, basename($tmpFile))->deleteFileAfterSend();
    }
}
