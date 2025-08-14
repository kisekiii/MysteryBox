@extends('panel.partial.main')
@section('title', 'box create')
@section('content')
<div class="max-w-2xl">
    <h2 class="text-xl font-bold mb-8">Tambah Mystery Box</h2>
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('box.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-2">Nama Box</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full border-gray-400 border-1 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
            @error('name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2">Background Belakang (optional)</label>
            <input type="file" name="bg_back"
                class="file:bg-blue-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border-gray-400 border-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                accept="image/*"/>
            @error('bg_back')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-2">Background Atas (optional)</label>
            <input type="file" name="bg_top"
                class="file:bg-blue-400 file:text-white file:rounded file:px-4 file:py-2 file:mr-4 w-full border-gray-400 border-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                accept="image/*"/>
            @error('bg_top')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="pt-2 flex space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-10 py-3 rounded-xl shadow transition">
                Simpan
            </button>
            <a href="{{ route('box.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-10 py-3 rounded-xl font-semibold transition">
                Batal
            </a>
        </div>
    </form>
</div>


@endsection
