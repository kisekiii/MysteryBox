@extends('panel.partial.main')
@section('title', 'Dashboard')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
    {{-- Total Tickets --}}
    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="text-sm text-gray-500">Total tickets</div>
        <div class="mt-1 text-3xl font-semibold">{{ number_format($total) }}</div>
        <div class="mt-3 text-sm text-gray-600 flex justify-between">
            <span>Claimed:</span>
            <span class="font-medium">{{ number_format($claimed) }}</span>
        </div>
        <div class="text-sm text-gray-600 flex justify-between">
            <span>Unclaimed:</span>
            <span class="font-medium">{{ number_format($unclaimed) }}</span>
        </div>
    </div>

    {{-- New (Last 30 Days) --}}
    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="text-sm text-gray-500">New tickets (Last 30 days)</div>
        <div class="mt-1 text-3xl font-semibold">{{ number_format($newLast30) }}</div>
        <div class="mt-3 text-sm text-gray-600 flex justify-between">
            <span>Claimed in 30d:</span>
            <span class="font-medium">{{ number_format($claimedLast30) }}</span>
        </div>
    </div>

    {{-- Claimed Activity --}}
    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="text-sm text-gray-500">Claimed tickets</div>
        <div class="mt-1 text-3xl font-semibold">{{ number_format($claimed) }}</div>
        <div class="mt-3 text-sm text-gray-600 flex justify-between">
            <span>Last 7 days:</span>
            <span class="font-medium">{{ number_format($claimedLast7) }}</span>
        </div>
        <div class="text-sm text-gray-600 flex justify-between">
            <span>Today:</span>
            <span class="font-medium">{{ number_format($claimedToday) }}</span>
        </div>
    </div>

    {{-- Claim Rate --}}
    <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">Claim rate</div>
            @if($rateDelta !== 0)
                <span class="text-xs px-2 py-1 rounded-full {{ $rateDelta >= 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $rateDelta >= 0 ? '↑' : '↓' }} {{ abs($rateDelta) }}%
                </span>
            @endif
        </div>
        <div class="mt-1 text-3xl font-semibold">{{ $rateNow }}%</div>
        <div class="mt-3 text-xs text-gray-500">vs previous 30 days</div>
    </div>
</div>
@endsection
