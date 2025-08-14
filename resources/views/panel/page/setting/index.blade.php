@extends('panel.partial.main')
@section('title', 'Dashboard')
@section('content')
<div class="mx-auto max-w-4xl py-8 bg-white rounded-2xl shadow-xl">
    <H1 class="text-center text-2xl font-bold uppercase my-4"> Setting Website </H1>
    <div class="  px-8  w-full max-w-4xl flex flex-col md:flex-row gap-10">
        <div class="flex flex-col gap-8 w-full md:w-72">
            <!-- Icon Website -->
            <div class="w-full h-[120px] rounded-2xl shadow border-2 border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                @if($setting && $setting->icon)
                    <img src="{{ asset('storage/'.$setting->icon) }}" class="w-full h-full object-cover" alt="icon">
                @else
                    <span class="text-gray-400 font-semibold">Icon Website</span>
                @endif
            </div>
            <!-- Background Website -->
            <div class="w-full h-[120px] rounded-2xl shadow border-2 border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                @if($setting && $setting->background)
                    <img src="{{ asset('storage/'.$setting->background) }}" class="w-full h-full object-cover" alt="bg">
                @else
                    <span class="text-gray-400 font-semibold">Background</span>
                @endif
            </div>
        </div>
        <!-- Kolom kanan: Info setting -->
       <div class="flex-1 flex flex-col justify-between min-h-[260px]">
            @if($setting)
                <div class="space-y-5 mt-2">
                    <div class="flex items-start">
                        <span class="w-32 font-semibold text-gray-700">Nama Website:</span>
                        <span class="flex-1 text-gray-800">{{ $setting->site_name }}</span>
                    </div>
                    <div class="flex items-start">
                        <span class="w-32 font-semibold text-gray-700">Link Login:</span>
                        <a href="{{ $setting->link_login }}" class="flex-1 text-blue-600 underline break-all">{{ $setting->link_login }}</a>
                    </div>
                    <div class="flex items-start">
                        <span class="w-32 font-semibold text-gray-700">Link Claim:</span>
                        <a href="{{ $setting->link_claim }}" class="flex-1 text-blue-600 underline break-all">{{ $setting->link_claim }}</a>
                    </div>
                </div>
                <div class="flex justify-end mt-8">
                    <a href="{{ route('setting.edit', $setting->id) }}"
                    class="bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700 shadow transition">
                        Edit Setting
                    </a>
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-full w-full">
                    <a href="{{ route('setting.create') }}"
                    class="bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700 shadow">
                        Tambah Setting
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>



@endsection
