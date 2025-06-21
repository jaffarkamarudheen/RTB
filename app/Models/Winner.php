<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_slot_id',
        'user_id',
        'bid_id',
        'winning_amount',
    ];

    public function adSlot()
    {
        return $this->belongsTo(AdSlot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}