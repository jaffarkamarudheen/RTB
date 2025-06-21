<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Bid;
use App\Models\AdSlot;

class ProcessBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $adSlotId;
    protected $amount;

    public function __construct($userId, $adSlotId, $amount)
    {
        $this->userId = $userId;
        $this->adSlotId = $adSlotId;
        $this->amount = $amount;
    }

    public function handle()
    {
        // Check if the ad slot is still open
        $adSlot = AdSlot::find($this->adSlotId);

        if (!$adSlot || $adSlot->status !== 'open') {
            return;
        }

        // Create the bid
        Bid::create([
            'user_id' => $this->userId,
            'ad_slot_id' => $this->adSlotId,
            'amount' => $this->amount,
        ]);
    }
}