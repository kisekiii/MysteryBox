@extends('mysterybox.partial.main')
@section('title', 'Daftar Semua Hadiah')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen"
     style="background: url('{{ $setting && $setting->background
        ? asset('storage/' . $setting->background)
        : asset('/assets/img/back/bg-default.jpg') }}') center center / cover no-repeat fixed;">
        <div class="text-center mb-8">
            <img src="{{ $setting && $setting->icon
                ? asset('storage/' . $setting->icon)
                : asset('/assets/img/logo/logo-sub.png') }}"
                alt="{{ $setting->site_name ?? 'Mystery Box' }}"
                class="mx-auto w-52 xl:w-md mb-2" />
        </div>
    <div class="w-full max-w-3xl bg-black/70 backdrop:blur-2xl rounded-2xl p-4 mb-8">
        <div id="prizeGrid" class="grid grid-cols-2 gap-8 md:grid-cols-4 md:grid-rows-2">
            @foreach($prizes as $i => $prize)
            <div class="prize-box flex flex-col items-center justify-center relative select-none pointer-events-none" data-idx="{{ $i }}">
                {{-- Tutup box --}}
                <img src="{{ $prize->box && $prize->box->bg_top ? asset('storage/'.$prize->box->bg_top) : asset('/assets/img/kotak/tutup.png') }}"
                    class="box-lid absolute left-1/2 -top-5 -translate-x-1/2 w-36 z-20 transition-all duration-500" />
                {{-- Box --}}
                <img src="{{ $prize->box && $prize->box->bg_back ? asset('storage/'.$prize->box->bg_back) : asset('/assets/img/kotak/kotak.png') }}"
                    class="box-body w-36 relative z-10" />
                {{-- Hadiah --}}
                <div class="prize-content absolute inset-0 flex flex-col items-center justify-center opacity-100 bg-black/50 rounded-2xl"
                    style="z-index:30;">
                    <img src="{{ asset('storage/'.$prize->image) }}" alt="{{ $prize->name }}"
                        class="w-36 h-36 mx-auto mb-2 object-contain rounded" />
                    <span class="text-base font-bold text-white text-center drop-shadow">{{ $prize->name }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('mysterybox.index') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow transition block text-center w-full max-w-sm">
       Kembali ke Klaim Tiket
    </a>
</div>

{{-- Animasi buka tutup box --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const boxes = document.querySelectorAll('.prize-box');
    boxes.forEach(box => {
        // Pastikan tutup dan hadiah hidden awal
        box.querySelector('.box-lid').style.transform = '';
        box.querySelector('.prize-content').style.opacity = 0;
    });

    // Animasi buka satu per satu
    let i = 0;
    function openBoxSequentially() {
        if (i >= boxes.length) return;
        const box = boxes[i];
        // Tutup box animasi ke atas dan putar
        const lid = box.querySelector('.box-lid');
        lid.style.transform = 'translateY(-60px) rotate(-25deg) scale(1.08)';
        lid.style.opacity = 0.7;
        // Tampilkan hadiah
        setTimeout(() => {
            lid.style.display = 'none';
            box.querySelector('.prize-content').style.opacity = 1;
        }, 400);
        // Next box (delay 300ms per box)
        i++;
        setTimeout(openBoxSequentially, 300);
    }

    openBoxSequentially();
});
</script>
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
