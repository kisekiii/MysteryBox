<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MysteryBox extends Model
{
    protected $fillable = ['name', 'bg_back', 'bg_top'];

    public function prizes()
    {
        return $this->hasMany(MysteryBoxPrize::class);
    }
}
