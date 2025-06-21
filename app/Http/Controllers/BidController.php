<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\AdSlot;
use App\Jobs\ProcessBid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, $adSlotId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $adSlot = AdSlot::findOrFail($adSlotId);

        if ($adSlot->status !== 'open') {
            return response()->json([
                'message' => 'Bidding is not open for this ad slot',
            ], 400);
        }

        if ($request->amount < $adSlot->min_bid_price) {
            return response()->json([
                'message' => 'Bid amount must be at least the minimum bid price',
            ], 400);
        }

        // Dispatch the bid to a queue for processing
        ProcessBid::dispatch(
            Auth::id(),
            $adSlotId,
            $request->amount
        );

        return response()->json([
            'message' => 'Bid is being processed',
        ], 202);
    }

    public function index($adSlotId)
    {
        $bids = Bid::with('user')
            ->where('ad_slot_id', $adSlotId)
            ->orderBy('amount', 'desc')
            ->get();

        return response()->json($bids);
    }

    public function userBids()
    {
        $bids = Bid::with('adSlot')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($bids);
    }

//     public function userBids()
// {
//     $bids = Bid::with(['adSlot', 'adSlot.winner'])
//         ->where('user_id', auth()->id())
//         ->orderBy('created_at', 'desc')
//         ->get();

//     if (request()->wantsJson()) {
//         return response()->json($bids);
//     }

//     return view('bids.index', compact('bids'));
// }
}