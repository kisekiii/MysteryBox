@extends('mysterybox.partial.main')
@section('title', 'History Hadiah')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen"
     style="background: url('{{ $setting && $setting->background
        ? asset('storage/' . $setting->background)
        : asset('/assets/img/back/bg-default.jpg') }}') center center / cover no-repeat fixed;">
    <div class="shadow p-8 text-center bg-white/95 rounded-2xl backdrop-blur-2xl  border-1 border-white">
        <h2 class="text-2xl font-bold mb-4">HADIAH TIKET</h2>
        <img src="{{ asset('storage/'.$prize->image) }}" alt="Prize" class="w-36 h-36 mx-auto mb-2" />
        <div class="text-xl font-semibold">{{ $prize->name }}</div>
        <div class="text-gray-600">Kode Tiket: <b>{{ $ticket->code }}</b></div>
        <div class="flex flex-wrap gap-3 justify-center my-2">
            <a href="{{ route('mysterybox.index') }}" class="py-2 px-4 bg-blue-500 text-white rounded-md">Kembali</a>
            @php
                $whatsappUrl = optional($setting)->link_claim;
                if ($whatsappUrl && !Str::startsWith($whatsappUrl, ['http://', 'https://'])) {
                    $whatsappUrl = 'https://' . $whatsappUrl;
                }
            @endphp
            <a href="{{ $whatsappUrl ?? '#' }}" target="_blank" class="py-2 px-4 bg-green-600 text-white rounded-md">Ambil Sekarang</a>
        </div>
        <p class="text-center text-red-700 text-sm">Screenshot dan kirimkan ke admin kami.</p>
    </div>
</div>
<script>
// Blokir klik kanan
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

// Blokir F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
document.addEventListener('keydown', function(e) {
    if (e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
        (e.ctrlKey && e.key === 'U')) {
        e.preventDefault();
    }
});

// Deteksi DevTools dibuka (metode waktu render)
setInterval(function() {
    const start = performance.now();
    debugger;
    const end = performance.now();
    if (end - start > 100) {
        alert('Developer tools terdeteksi, akses diblokir!');
        window.location.href = "about:blank";
    }
}, 200);
</script>
@endsection
