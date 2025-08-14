<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MysteryBox;
use Illuminate\Support\Facades\Storage;

class BoxController extends Controller
{
    // Tampilkan daftar box
    public function index()
    {
        $boxes = MysteryBox::all();
        return view('panel.page.box.index', compact('boxes'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('panel.page.box.create');
    }

    // Simpan box baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'bg_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bg_top'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload bg_back
        if ($request->hasFile('bg_back')) {
            $validated['bg_back'] = $request->file('bg_back')->store('box_bg', 'public');
        }

        // Upload bg_top
        if ($request->hasFile('bg_top')) {
            $validated['bg_top'] = $request->file('bg_top')->store('box_bg', 'public');
        }

        MysteryBox::create($validated);

        return redirect()->route('box.index')->with('success', 'Box berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $box = MysteryBox::findOrFail($id);
        return view('panel.page.box.edit', compact('box'));
    }

    // Update box
    public function update(Request $request, $id)
    {
        $box = MysteryBox::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'bg_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bg_top'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle bg_back
        if ($request->hasFile('bg_back')) {
            // Hapus lama kalau ada
            if ($box->bg_back && Storage::disk('public')->exists($box->bg_back)) {
                Storage::disk('public')->delete($box->bg_back);
            }
            $validated['bg_back'] = $request->file('bg_back')->store('box_bg', 'public');
        }

        // Handle bg_top
        if ($request->hasFile('bg_top')) {
            if ($box->bg_top && Storage::disk('public')->exists($box->bg_top)) {
                Storage::disk('public')->delete($box->bg_top);
            }
            $validated['bg_top'] = $request->file('bg_top')->store('box_bg', 'public');
        }

        $box->update($validated);

        return redirect()->route('box.index')->with('success', 'Box berhasil diupdate!');
    }

    // Hapus box
    public function destroy($id)
    {
        $box = MysteryBox::findOrFail($id);

        // Cek dan hapus semua child yang terkait (tiket dan prize)
        foreach ($box->prizes as $prize) {
            // Hapus tiket yang pakai prize ini
            \App\Models\Ticket::where('prize_id', $prize->id)->delete();
            // Hapus prize itu sendiri
            $prize->delete();
        }

        // Hapus gambar dari storage
        if ($box->bg_back && Storage::disk('public')->exists($box->bg_back)) {
            Storage::disk('public')->delete($box->bg_back);
        }
        if ($box->bg_top && Storage::disk('public')->exists($box->bg_top)) {
            Storage::disk('public')->delete($box->bg_top);
        }

        $box->delete();

        return redirect()->route('box.index')->with('success', 'Box berhasil dihapus!');
    }
}
