@extends('panel.partial.main')
@section('title', 'Edit Tiket')
@section('content')
<div class="max-w-2xl">
    <h2 class="text-xl font-bold mb-8">Edit Setting Website</h2>
    <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block font-semibold mb-2">Nama Website</label>
            <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" required class="w-full border-gray-400 border-1 rounded px-4 py-2 focus:ring-2 focus:ring-blue-200">
            @error('site_name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-2">Icon Website</label>
            @if($setting->icon)
                <img src="{{ asset('storage/'.$setting->icon) }}" class="h-1/2 w-1/2 rounded bg-gray-50 mb-2" alt="icon">
            @endif
            <input type="file" name="icon" accept="image/*"
                class="file:bg-blue-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border-gray-400 border-1 rounded">
            @error('icon')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-2">Background Website</label>
            @if($setting->background)
                <img src="{{ asset('storage/'.$setting->background) }}" class="h-1/2 w-1/2 rounded bg-gray-50 mb-2" alt="bg">
            @endif
            <input type="file" name="background" accept="image/*"
                class="file:bg-blue-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border-gray-400 border-1 rounded">
            @error('background')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-2">Link Login</label>
            <input type="text" name="link_login" value="{{ old('link_login', $setting->link_login) }}" class="w-full border-gray-400 border-1 rounded px-4 py-2 focus:ring-2 focus:ring-blue-200">
            @error('link_login')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-2">Link Claim</label>
            <input type="text" name="link_claim" value="{{ old('link_claim', $setting->link_claim) }}" class="w-full border-gray-400 border-1 rounded px-4 py-2 focus:ring-2 focus:ring-blue-200">
            @error('link_claim')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-10 py-3 rounded-xl shadow transition">
            Update
        </button>
    </form>
</div>
@endsection
