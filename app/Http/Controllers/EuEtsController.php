<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EuEtsService;

class EuEtsController extends Controller
{
    protected $euEtsService;

    public function __construct(EuEtsService $euEtsService)
    {
        $this->euEtsService = $euEtsService;
    }

    public function index()
    {
        $data = $this->euEtsService->calculateEUEts();
        return view('eu_ets.index',  compact('data'));
    }
}
