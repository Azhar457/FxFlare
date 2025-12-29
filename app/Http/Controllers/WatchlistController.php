<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Services\CoinGeckoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CoinGeckoService $coinGecko)
    {
        // Update prices from CoinGecko API (with caching)
        $coinGecko->updateAssetPrices();

        $user = Auth::user();
        $query = $user->watchlist();

        // Search - properly scoped to user's watchlist only
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('symbol', 'like', '%' . $searchTerm . '%');
            });
        }

        // Sort
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'change_asc':
                    $query->orderBy('change_24h', 'asc');
                    break;
                case 'change_desc':
                    $query->orderBy('change_24h', 'desc');
                    break;
            }
        } else {
            // Default sort
            $query->orderBy('symbol', 'asc');
        }

        $watchlist = $query->get();
        // For adding new assets, we might want to see all available assets
        // This is a simple implementation; in production, you'd likely have a search endpoint.
        $allAssets = Asset::all();

        return view('watchlist.index', compact('watchlist', 'allAssets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
        ]);

        $user = Auth::user();

        if (!$user->watchlist()->where('asset_id', $request->asset_id)->exists()) {
            $user->watchlist()->attach($request->asset_id);
            return back()->with('success', 'Asset added to watchlist.');
        }

        return back()->with('info', 'Asset is already in your watchlist.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $user = Auth::user();

        // Check if asset exists in user's watchlist before attempting to remove
        if (!$user->watchlist()->where('asset_id', $asset->id)->exists()) {
            return back()->with('error', 'Asset not found in your watchlist.');
        }

        // Remove asset from user's watchlist
        $user->watchlist()->detach($asset->id);
        return back()->with('success', 'Asset removed from watchlist successfully.');
    }
}
