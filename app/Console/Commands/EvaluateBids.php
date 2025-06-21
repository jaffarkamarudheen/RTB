<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdSlot;
use App\Models\Bid;
use App\Models\Winner;
use Carbon\Carbon;

class EvaluateBids extends Command
{
    protected $signature = 'bids:evaluate';
    protected $description = 'Evaluate bids for closed ad slots and select winners';

    public function handle()
    {
        $now = Carbon::now();

        // Get ad slots that have ended but not yet awarded
        $adSlots = AdSlot::where('end_time', '<=', $now)
            ->where('status', '!=', 'awarded')
            ->get();

        foreach ($adSlots as $adSlot) {
            // Get the highest bid for this ad slot
            $winningBid = Bid::where('ad_slot_id', $adSlot->id)
                ->orderBy('amount', 'desc')
                ->orderBy('bid_time', 'asc')
                ->first();

            if ($winningBid) {
                // Create winner record
                Winner::create([
                    'ad_slot_id' => $adSlot->id,
                    'user_id' => $winningBid->user_id,
                    'bid_id' => $winningBid->id,
                    'winning_amount' => $winningBid->amount,
                ]);

                // Update ad slot status
                $adSlot->update(['status' => 'awarded']);
            } else {
                // No bids, just close the slot
                $adSlot->update(['status' => 'closed']);
            }
        }

        $this->info('Evaluated ' . count($adSlots) . ' ad slots.');
    }
}