<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MysteryBox;

class MysteryBoxSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Box utama
        $box = MysteryBox::create([
            'name'     => 'Glowin88 Box',
            'bg_back'  => 'https://angkaku.b-cdn.net/rtp/machine/backgrounds/BELAKANG.png',
            'bg_top'   => 'https://angkaku.b-cdn.net/rtp/machine/backgrounds/ATAS.png',
            'bg_left'  => 'https://angkaku.b-cdn.net/rtp/machine/backgrounds/KIRI.png',
            'bg_right' => 'https://angkaku.b-cdn.net/rtp/machine/backgrounds/KANAN.png',
        ]);

        // 2. Data hadiah-hadiah yang akan dimasukkan ke box ini
        $prizes = [
            ['name' => 'Rp 10.000',       'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/2_prize_1753026897.png',   'order_position' => 1],
            ['name' => 'Rp 15.000',       'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/7_prize_1753026905.png',   'order_position' => 2],
            ['name' => 'Rp 50.000',       'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/8_prize_1753027546.png',   'order_position' => 3],
            ['name' => 'Rp 100.000',      'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/3_prize_1753027553.png',   'order_position' => 4],
            ['name' => 'Rp 1.000.000',    'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/SDVDSVDS_prize_1753027559.png',   'order_position' => 5],
            ['name' => 'Rp 5.000.000',    'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/fsdsvdsvds_prize_1753027567.png',  'order_position' => 6],
            ['name' => 'IPHONE 15 PRO MAX','image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/1_prize_1753027573.png',  'order_position' => 7],
            ['name' => 'HONDA SCOOPY',    'image' => 'https://angkaku.b-cdn.net/rtp/machine/prizes/5_prize_1753027580.png',   'order_position' => 8],
        ];

        // 3. Masukkan hadiah ke table prizes (otomatis foreign key ke box ini)
        $box->prizes()->createMany($prizes);
    }
}
