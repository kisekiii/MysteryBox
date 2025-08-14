<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\MysteryBoxPrize;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     */
    public function index()
    {
       $tickets = Ticket::with('prize')
        ->when(request('q'), function($q) {
            $q->where('code', 'like', '%'.request('q').'%');
        })
        ->latest()
        ->paginate(10);
        return view('panel.page.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        $prizes = MysteryBoxPrize::all();
        return view('panel.page.ticket.create', compact('prizes'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codes'   => 'required|array|min:1',
            'codes.*' => 'required|string|max:32|distinct|unique:tickets,code',
            'prize_id' => 'required|exists:mystery_box_prizes,id',
        ], [
            'codes.*.unique' => 'Kode tiket ":input" sudah terpakai.',
            'codes.*.distinct' => 'Kode tiket tidak boleh sama.',
        ]);

        foreach ($request->codes as $code) {
            Ticket::create([
                'code' => $code,
                'prize_id' => $request->prize_id,
            ]);
        }

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified ticket.
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $prizes = MysteryBoxPrize::all();
        return view('panel.page.ticket.edit', compact('ticket', 'prizes'));
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $request->validate([
            'code' => 'required|string|max:32|unique:tickets,code,' . $ticket->id,
            'prize_id' => 'required|exists:mystery_box_prizes,id',
        ]);

        $ticket->update([
            'code' => $request->code,
            'prize_id' => $request->prize_id,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil diupdate.');
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('ticket.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
