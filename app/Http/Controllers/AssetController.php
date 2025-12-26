<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        // Get user's active alerts for this asset
        $alerts = Auth::user()->priceAlerts()->where('asset_id', $asset->id)->get();
        
        // Mocking some chart data for the view
        $chartData = [];
        $basePrice = $asset->price;
        for ($i = 0; $i < 24; $i++) {
            $chartData[] = $basePrice * (1 + (rand(-10, 10) / 1000));
        }

        return view('assets.show', compact('asset', 'alerts', 'chartData'));
    }
}
