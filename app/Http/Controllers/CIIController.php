<?php
namespace App\Http\Controllers;

use App\Services\CIIService;

class CIIController extends Controller
{
    public function index(CIIService $ciiService)
    {
        try {
            $vessels = $ciiService->calculateCII();
            return view('cii_rating.index', compact('vessels'));
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Error calculating CII: ' . $e->getMessage()], 500);
        }
    }
}
