@extends('panel.partial.main')
@section('title', 'box edit')
@section('content')
<div class="max-w-2xl mx-auto py-10 px-8 bg-white rounded-2xl shadow">
    <h2 class="text-xl font-bold mb-8">Edit Mystery Box</h2>
    <form action="{{ route('box.update', $box->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold mb-2">Nama Box</label>
            <input type="text" name="name" value="{{ old('name', $box->name) }}" required
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#a259ff]"/>
            @error('name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2">Background Belakang</label>
            @if($box->bg_back)
                <img src="{{ asset('storage/'.$box->bg_back) }}" class="h-14 w-14 object-cover rounded mb-2 border border-gray-200 shadow" />
            @endif
            <input type="file" name="bg_back"
                class="file:bg-gray-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border rounded focus:outline-none focus:ring-2 focus:ring-[#a259ff]"
                accept="image/*"/>
            @error('bg_back')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2">Background Atas</label>
            @if($box->bg_top)
                <img src="{{ asset('storage/'.$box->bg_top) }}" class="h-14 w-14 object-cover rounded mb-2 border border-gray-200 shadow" />
            @endif
            <input type="file" name="bg_top"
                class="file:bg-gray-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border rounded focus:outline-none focus:ring-2 focus:ring-[#a259ff]"
                accept="image/*"/>
            @error('bg_top')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="pt-2 flex space-x-2">
            <button type="submit" class="bg-[#a259ff] hover:bg-[#8b49cc] text-white font-semibold px-10 py-3 rounded-xl shadow transition">
                Update
            </button>
            <a href="{{ route('box.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-10 py-3 rounded-xl font-semibold transition">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
