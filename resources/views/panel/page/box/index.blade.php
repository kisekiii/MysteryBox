@extends('panel.partial.main')
@section('title', 'box setting')
@section('content')
<div class="mx-auto max-w-4xl py-8">
    <div class="flex flex-wrap justify-between">

        <h1 class="text-xl font-bold mb-6">Daftar Mystery Box</h1>
        <a href="{{ route('box.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Box</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm bg-white">
        <table class="min-w-full divide-y divide-gray-100">
            <thead>
                <tr>
                    <th class="py-4 px-6 text-left font-bold text-gray-700 bg-gray-50">Nama</th>
                    <th class="py-4 px-6 text-left font-bold text-gray-700 bg-gray-50">Bg Back</th>
                    <th class="py-4 px-6 text-left font-bold text-gray-700 bg-gray-50">Bg Top</th>
                    <th class="py-4 px-6 text-left font-bold text-gray-700 bg-gray-50">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($boxes as $box)
                    @if($box->name || $box->bg_back || $box->bg_top)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- Nama -->
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                {{ $box->name }}
                            </td>
                            <!-- Bg Back -->
                            <td class="py-4 px-6">
                                @if($box->bg_back)
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/'.$box->bg_back) }}" class="h-12 w-12 rounded-lg object-cover border border-gray-200 shadow" />
                                    </div>
                                @endif
                            </td>
                            <!-- Bg Top -->
                            <td class="py-4 px-6">
                                @if($box->bg_top)
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/'.$box->bg_top) }}" class="h-12 w-12 rounded-lg object-cover border border-gray-200 shadow" />
                                    </div>
                                @endif
                            </td>
                            <!-- Aksi -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('box.edit', $box->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('box.destroy', $box->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus box ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4" class="py-8 px-6 text-center text-gray-500">Belum ada box.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
