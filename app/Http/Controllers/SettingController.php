<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Tampilkan halaman index
    public function index()
    {
        $setting = Setting::first();
        return view('panel.page.setting.index', compact('setting'));
    }

    // Tampilkan form create (jika belum ada setting)
    public function create()
    {
        return view('panel.page.setting.create');
    }

    // Simpan setting baru
    public function store(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:100',
            'icon'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'background'   => 'nullable|image|mimes:png,jpg,jpeg,svg|max:4096',
            'link_login'   => 'nullable|string|max:255',
            'link_claim'   => 'nullable|string|max:255',
        ]);

        $data = $request->except('icon', 'background');

        // Upload icon jika ada
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('settings', 'public');
        }

        // Upload background jika ada
        if ($request->hasFile('background')) {
            $data['background'] = $request->file('background')->store('settings', 'public');
        }

        Setting::create($data);

        return redirect()->route(route: 'setting.index')->with('success', 'Setting berhasil disimpan!');
    }

    // Tampilkan form edit
    public function edit(Setting $setting)
    {
        return view('panel.page.setting.edit', compact('setting'));
    }

    // Update setting
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'site_name'    => 'required|string|max:100',
            'icon'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'background'   => 'nullable|image|mimes:png,jpg,jpeg,svg|max:4096',
            'link_login'   => 'nullable|string|max:255',
            'link_claim'   => 'nullable|string|max:255',
        ]);

        $data = $request->except('icon', 'background');

        // Handle upload icon baru
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($setting->icon && Storage::disk('public')->exists($setting->icon)) {
                Storage::disk('public')->delete($setting->icon);
            }
            $data['icon'] = $request->file('icon')->store('settings', 'public');
        }

        // Handle upload background baru
        if ($request->hasFile('background')) {
            if ($setting->background && Storage::disk('public')->exists($setting->background)) {
                Storage::disk('public')->delete($setting->background);
            }
            $data['background'] = $request->file('background')->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()->route('setting.index')->with('success', 'Setting berhasil diupdate!');
    }
}
