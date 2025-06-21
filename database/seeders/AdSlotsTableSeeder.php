<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdSlot;
use Carbon\Carbon;

class AdSlotsTableSeeder extends Seeder
{
    public function run()
    {
        // Upcoming ad slot
        AdSlot::create([
            'name' => 'Homepage Banner',
            'description' => 'Main banner on homepage',
            'min_bid_price' => 100.00,
            'start_time' => Carbon::now()->addDays(1),
            'end_time' => Carbon::now()->addDays(2),
            'status' => 'upcoming',
        ]);

        // Currently open ad slot
        AdSlot::create([
            'name' => 'Sidebar Ad',
            'description' => 'Right sidebar advertisement',
            'min_bid_price' => 50.00,
            'start_time' => Carbon::now()->subHours(1),
            'end_time' => Carbon::now()->addHours(23),
            'status' => 'open',
        ]);

        // Closed ad slot
        AdSlot::create([
            'name' => 'Footer Ad',
            'description' => 'Footer section advertisement',
            'min_bid_price' => 30.00,
            'start_time' => Carbon::now()->subDays(2),
            'end_time' => Carbon::now()->subDays(1),
            'status' => 'closed',
        ]);
    }
}