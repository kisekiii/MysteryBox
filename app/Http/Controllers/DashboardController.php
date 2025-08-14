<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Buat controller ini hanya bisa diakses oleh user yang sudah login.
     */
    public function __construct() {}

    /**
     * Tampilkan halaman dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        $now = now();
        $last30 = $now->clone()->subDays(30);
        $prev30_start = $now->clone()->subDays(60);
        $prev30_end   = $now->clone()->subDays(30);

        // Statistik dasar
        $total         = Ticket::count();
        $claimed       = Ticket::whereNotNull('claimed_at')->count();
        $unclaimed     = $total - $claimed;

        // Tiket baru & klaim baru (30 hari terakhir)
        $newLast30     = Ticket::where('created_at', '>=', $last30)->count();
        $claimedLast30 = Ticket::whereNotNull('claimed_at')
                                ->where('claimed_at', '>=', $last30)
                                ->count();

        // Aktivitas klaim
        $claimedLast7  = Ticket::whereNotNull('claimed_at')
                                ->where('claimed_at', '>=', $now->clone()->subDays(7))
                                ->count();
        $claimedToday  = Ticket::whereNotNull('claimed_at')
                                ->whereDate('claimed_at', $now->toDateString())
                                ->count();

        // Claim rate & perbandingan dengan periode sebelumnya
        $rateNow   = $total > 0 ? round(($claimed / $total) * 100) : 0;
        $prevTotal   = Ticket::whereBetween('created_at', [$prev30_start, $prev30_end])->count();
        $prevClaimed = Ticket::whereNotNull('claimed_at')
                            ->whereBetween('claimed_at', [$prev30_start, $prev30_end])
                            ->count();
        $ratePrev    = $prevTotal > 0 ? ($prevClaimed / $prevTotal) * 100 : 0;
        $rateDelta   = round($rateNow - $ratePrev);

        return view('panel.page.index', compact(
            'user',
            'total',
            'claimed',
            'unclaimed',
            'newLast30',
            'claimedLast30',
            'claimedLast7',
            'claimedToday',
            'rateNow',
            'rateDelta'
        ));
    }
}
