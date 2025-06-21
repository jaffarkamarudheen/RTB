<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Winner;
use App\Models\AdSlot;

class WinnerController extends Controller
{
    public function show($adSlotId)
    {
        $winner = Winner::with(['user', 'bid'])
            ->where('ad_slot_id', $adSlotId)
            ->first();

        if (!$winner) {
            return response()->json([
                'message' => 'No winner has been selected yet for this ad slot',
            ], 404);
        }

        return response()->json($winner);
    }
}