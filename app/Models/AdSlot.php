<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_bid_price',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function winner()
    {
        return $this->hasOne(Winner::class);
    }
}