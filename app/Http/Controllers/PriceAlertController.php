<?php

namespace App\Http\Controllers;

use App\Models\PriceAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceAlertController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'target_price' => 'required|numeric',
            'condition' => 'required|in:above,below',
        ]);

        Auth::user()->priceAlerts()->create([
            'asset_id' => $request->asset_id,
            'target_price' => $request->target_price,
            'condition' => $request->condition,
            'status' => 'active',
        ]);

        return back()->with('success', 'Price alert set successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceAlert $priceAlert)
    {
        // Ensure user owns the alert
        if ($priceAlert->user_id !== Auth::id()) {
            abort(403);
        }

        $priceAlert->delete();

        return back()->with('success', 'Price alert removed.');
    }
}
