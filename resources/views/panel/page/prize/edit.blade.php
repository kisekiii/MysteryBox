@extends('panel.partial.main')
@section('title', 'Edit Hadiah')
@section('content')
<div class="container mx-auto py-8 max-w-lg">
    <h1 class="text-xl font-bold mb-6">Edit Hadiah</h1>
    <form action="{{ route('prize.update', $prize->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-medium">Nama Hadiah</label>
            <input type="text" name="name" value="{{ old('name', $prize->name) }}" class="border rounded w-full p-2" required>
            @error('name') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Hadiah</label>
            <input type="text" name="hadiah" value="{{ old('hadiah', $prize->hadiah) }}" class="border rounded w-full p-2" required>
            @error('hadiah') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Gambar Hadiah</label>
            @if($prize->image)
                <img src="{{ asset('storage/'.$prize->image) }}" class="h-16 mb-2 rounded">
            @endif
            <input type="file" name="image" class="border rounded w-full p-2" accept="image/*">
            @error('image') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium">Urutan Hadiah</label>
            <input type="number" name="order_position" value="{{ old('order_position', $prize->order_position) }}" min="1" class="border rounded w-full p-2" required>
            @error('order_position') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('prize.index') }}" class="bg-gray-300 px-5 py-2 rounded hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
