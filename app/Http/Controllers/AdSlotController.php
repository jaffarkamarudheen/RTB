<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdSlot;
use Carbon\Carbon;

class AdSlotController extends Controller
{
    public function index(Request $request)
    {
        $query = AdSlot::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $adSlots = $query->get();

        return response()->json($adSlots);
    }

    public function show($id)
    {
        $adSlot = AdSlot::with('bids.user')->findOrFail($id);

        return response()->json($adSlot);
    }


//     // Add these methods to your existing AdSlotController
// public function index(Request $request)
// {
//     $query = AdSlot::query();

//     if ($request->has('status')) {
//         $query->where('status', $request->status);
//     }

//     $adSlots = $query->orderBy('start_time')->get();

//     if ($request->wantsJson()) {
//         return response()->json($adSlots);
//     }

//     return view('ad-slots.index', compact('adSlots'));
// }

// public function show($id)
// {
//     $adSlot = AdSlot::with(['bids.user', 'winner.user'])->findOrFail($id);

//     if (request()->wantsJson()) {
//         return response()->json($adSlot);
//     }

//     return view('ad-slots.show', compact('adSlot'));
// }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_bid_price' => 'required|numeric|min:0',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $adSlot = AdSlot::create([
            'name' => $request->name,
            'description' => $request->description,
            'min_bid_price' => $request->min_bid_price,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'upcoming',
        ]);

        return response()->json($adSlot, 201);
    }


    
}