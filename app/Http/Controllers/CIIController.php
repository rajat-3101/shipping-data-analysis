<?php

namespace App\Http\Controllers;

use App\Services\CIIService;
use Illuminate\Http\Request;

class CIIController extends Controller
{
    public function calculateCII(CIIService $ciiService)
    {
        try {
            $ciiRating = $ciiService->calculateCII();
            return response()->json(['cii_rating' => $ciiRating], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Error calculating CII: ' . $e->getMessage()], 500);
        }
    }

    public function index(CIIService $ciiService)
    {
        $vessels = $ciiService->calculateCII();
        return view('cii_rating.index',$vessels,compact('vessels'));
        // return view('noon_report.create', compact('vessels', 'voyages', 'users'));
    }
}
