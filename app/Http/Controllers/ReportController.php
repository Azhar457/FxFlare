<?php

namespace App\Http\Controllers;

use App\Services\MarketDataService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $marketService;

    public function __construct(MarketDataService $marketService)
    {
        $this->marketService = $marketService;
    }

    public function index()
    {
        $coins = $this->marketService->getTopCoins(15);
        return view('reports.index', compact('coins'));
    }

    public function generatePdf()
    {
        $coins = $this->marketService->getTopCoins(15);
        
        // Ensure we have data, otherwise PDF might look empty
        $data = [
            'coins' => $coins,
            'date' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = Pdf::loadView('reports.pdf', $data);
        
        return $pdf->download('market-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
