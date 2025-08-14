@extends('panel.partial.main')
@section('title', 'Profile')
@section('content')
<div class="flex items-center justify-center">
    <form action="{{ route('user.update') }}" method="POST" class="w-full max-w-sm bg-white rounded-xl shadow p-6">
        @csrf
        @method('PUT')

        {{-- Notifikasi sukses/gagal --}}
        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="email">Your  email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email ?? '') }}"
                class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
                placeholder="name@company.com"
                required
            >
            @error('email')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
                required
            >
            @error('password')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="password_confirmation">Confirm password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400"
                required
            >
        </div>


        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 mt-2 text-center transition">
            Create an account
        </button>
    </form>
</div>

@endsection
