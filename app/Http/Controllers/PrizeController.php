<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MysteryBoxPrize;
use App\Models\MysteryBox;
use Illuminate\Support\Facades\Storage;

class PrizeController extends Controller
{
    public function index()
    {
        $prizes = MysteryBoxPrize::orderBy('order_position')->get();
        return view('panel.page.prize.index', compact('prizes'));
    }

    public function create()
    {
        // Tidak perlu box, langsung ke form
        return view('panel.page.prize.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'hadiah' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_position' => 'required|integer|min:1',
        ]);

        $box = MysteryBox::first();
        if (!$box) {
            return back()->with('error', 'Mystery Box belum ada, buat terlebih dulu.');
        }
        $validated['mystery_box_id'] = $box->id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('prizes', 'public');
            $validated['image'] = $path;
        }

       MysteryBoxPrize::create($validated);

        return redirect()->route('prize.create')->with('success', 'Hadiah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $prize = MysteryBoxPrize::findOrFail($id);
        return view('panel.page.prize.edit', compact('prize'));
    }

    public function update(Request $request, $id)
    {
        $prize = MysteryBoxPrize::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'hadiah' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order_position' => 'required|integer|min:1',
        ]);
        if ($request->hasFile('image')) {
            if ($prize->image && Storage::disk('public')->exists($prize->image)) {
                Storage::disk('public')->delete($prize->image);
            }
            $path = $request->file('image')->store('prizes', 'public');
            $validated['image'] = $path;
        } else {
            unset($validated['image']);
        }
        $prize->update($validated);
        return redirect()->route('prize.index')->with('success', 'Hadiah berhasil diupdate!');
    }

    public function destroy($id)
    {
        $prize = MysteryBoxPrize::findOrFail($id);
        if ($prize->image && Storage::disk('public')->exists($prize->image)) {
            Storage::disk('public')->delete($prize->image);
        }
        $prize->delete();
        return redirect()->route('prize.index')->with('success', 'Hadiah berhasil dihapus!');
    }
}
