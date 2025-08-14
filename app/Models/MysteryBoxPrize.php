<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MysteryBoxPrize extends Model
{
    protected $fillable = [
        'mystery_box_id',
        'name',
        'hadiah', // <-- Tambahkan ini!
        'image',
        'order_position',
    ];

    public function box()
    {
        return $this->belongsTo(MysteryBox::class, 'mystery_box_id');
    }
    public function mysteryBox()
    {
        return $this->belongsTo(MysteryBox::class, 'mystery_box_id');
    }
}
