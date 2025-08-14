<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\MysteryBox;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $box = MysteryBox::where('name', 'Glowin88 Box')->first();

        if (!$box) {
            $this->command->error('Box Glowin88 Box tidak ditemukan. Jalankan MysteryBoxSeeder dulu!');
            return;
        }

        foreach ($box->prizes as $prize) {
            // Buat tiket 10 - 20 per hadiah
            $total = rand(10, 20); // Bisa ganti ke jumlah tetap jika mau

            for ($i = 1; $i <= $total; $i++) {
                Ticket::create([
                    'code'      => 'TKT-' . $prize->id . '-' . strtoupper(Str::random(6)), // Misal: TKT-3-AB12CD
                    'prize_id'  => $prize->id,
                    'claimed_at'=> null,
                    'user_id'   => null,
                ]);
            }
        }
    }
}
