<?php

namespace App\Models;

use App\Models\User;
use App\Models\MysteryBoxPrize;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'code', 'prize_id', 'claimed_at', 'user_id'
    ];

    public function prize()
    {
        return $this->belongsTo(MysteryBoxPrize::class, 'prize_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
