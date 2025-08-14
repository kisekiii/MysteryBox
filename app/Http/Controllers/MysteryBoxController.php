<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Setting;
use App\Models\MysteryBox;
use Illuminate\Http\Request;
use App\Models\MysteryBoxPrize;

class MysteryBoxController extends Controller
{
    /**
     * Show input ticket form.
     */
    public function index()
    {
        $boxes = MysteryBox::all();
        $setting = Setting::first();
        $prizes = MysteryBox::all();
        return view('mysterybox.page.index', compact('boxes', 'prizes','setting'));
    }

    public function allPrizes()
    {
        $prizes = MysteryBoxPrize::with('box')->get();
        $setting = Setting::first();
        return view('mysterybox.page.allprizes', compact('prizes','setting'));
    }

    /**
     * Handle ticket code input and redirect accordingly.
     */
    public function check(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);
        $ticket = Ticket::with('prize')->where('code', $request->ticket_code)->first();
        if (!$ticket) {
            return back()->with('error', 'Tiket tidak ditemukan!');
        }
        if ($ticket->claimed_at) {
            return redirect()->route('mysterybox.history', $ticket->code); // <-- by code
        }
        return redirect()->route('mysterybox.open', $ticket->code); // <-- by code
    }

    /**
     * Show choose box view if not claimed, otherwise redirect to history.
                    */
        public function open($code)
        {
            $setting = Setting::first();
            $ticket = Ticket::with('prize')->where('code', $code)->firstOrFail();
            if ($ticket->claimed_at) {
                return redirect()->route('mysterybox.history', $ticket->code);
            }
            $boxes = MysteryBoxPrize::with('mysteryBox')->get();

            return view('mysterybox.page.open', [
                'ticket' => $ticket,
                'boxes'  => $boxes,
                'setting' => $setting
            ]);
        }


    public function claim(Request $request, $code)
    {
        $ticket = Ticket::where('code', $code)->firstOrFail();
        if ($ticket->claimed_at) {
            return response()->json(['success' => true]);
        }
        $ticket->claimed_at = Carbon::now();
        $ticket->save();
        return response()->json(['success' => true]);
    }

    public function history($code)
    {
        $setting = Setting::first();
        $ticket = Ticket::with('prize')->where('code', $code)->firstOrFail();
        return view('mysterybox.page.history', [
            'ticket' => $ticket,
            'prize'  => $ticket->prize,
            'setting' => $setting
        ]);
    }
}
