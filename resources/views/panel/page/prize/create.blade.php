@extends('panel.partial.main')
@section('title', 'Tambah Hadiah')
@section('content')
<div class="container mx-auto py-8 max-w-lg">
    <h1 class="text-xl font-bold mb-6">Tambah Hadiah</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    {{-- Notifikasi error umum --}}
    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Error validasi (semua field) --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prize.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-medium">Nama Hadiah</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border-gray-400 border-1 rounded-2xl w-full p-2" required>
            @error('name') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Hadiah</label>
            <input type="text" name="hadiah" value="{{ old('hadiah') }}" class="border-gray-400 border-1 rounded-2xl w-full p-2" required>
            @error('hadiah') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Gambar Hadiah</label>
            <input type="file" name="image" class="border-gray-400 border-1 rounded-2xl w-full p-2" required accept="image/*">
            @error('image') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Urutan Hadiah</label>
            <input type="number" name="order_position" value="{{ old('order_position', 1) }}" min="1" class="border-gray-400 border-1 rounded-2xl w-full p-2" required>
            @error('order_position') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('prize.index') }}" class="bg-gray-300 px-5 py-2 rounded hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
