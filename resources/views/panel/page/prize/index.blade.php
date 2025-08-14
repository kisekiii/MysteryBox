@extends('panel.partial.main')
@section('title', 'Daftar Hadiah')
@section('content')
<div class="max-w-4xl mx-auto p-2 border border-gray-100 shadow rounded-2xl">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-3">
        <div class="flex-1">
            <input type="text" placeholder="Search" class="w-full md:w-72 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-200 focus:outline-none text-sm bg-white" />
        </div>
        <a href="{{ route('prize.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition text-sm">
            + Tambah Hadiah
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl  bg-white">
        <table class="min-w-full divide-y divide-gray-100 text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-500 uppercase text-xs font-bold">
                    <th class="py-4 px-6 text-left">Nama Hadiah</th>
                    <th class="py-4 px-6 text-left">Hadiah</th>
                    <th class="py-4 px-6 text-left">Gambar</th>
                    <th class="py-4 px-6 text-left">Urutan</th>
                    <th class="py-4 px-6 text-center">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($prizes as $prize)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-6 text-gray-700">
                        {{ $prize->name }}
                    </td>
                    <!-- Hadiah -->
                    <td class="py-4 px-6 text-gray-700">{{ $prize->hadiah }}</td>
                    <!-- Gambar Hadiah (besar) -->
                    <td class="py-4 px-6">
                        @if($prize->image)
                            <img src="{{ asset('storage/' . $prize->image) }}" alt="Prize Image" class="h-12 max-w-[80px] rounded-lg object-cover border border-gray-200">
                        @endif
                    </td>
                    <!-- Urutan -->
                    <td class="py-4 px-6 text-gray-700">{{ $prize->order_position }}</td>
                    <!-- Aksi -->
                    <td class="py-4 px-6 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{ route('prize.edit', $prize->id) }}"
                               class="hover:bg-gray-100 rounded-full p-2"
                               title="Edit">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 1 1 2.828 2.828L11.828 13.828a4 4 0 0 1-2.828 1.172H7v-2a4 4 0 0 1 1.172-2.828z"/>
                                </svg>
                            </a>
                            <form action="{{ route('prize.destroy', $prize->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus hadiah ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="hover:bg-gray-100 rounded-full p-2" title="Hapus">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-400">Belum ada hadiah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
