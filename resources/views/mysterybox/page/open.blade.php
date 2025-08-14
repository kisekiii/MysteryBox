@extends('mysterybox.partial.main')
@section('title', 'Mystery Box')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center"
     style="background: url('{{ optional($setting)->background
        ? asset('storage/' . $setting->background)
        : asset('/assets/img/back/bg-default.jpg') }}') center center / cover no-repeat fixed;">

    <div class="mb-8 text-center">
        <img src="{{ optional($setting)->icon
                ? asset('storage/' . $setting->icon)
                : asset('/assets/img/logo/logo-sub.png') }}"
             alt="{{ optional($setting)->site_name ?? 'Logo-sub' }}"
             class="mx-auto w-40 xl:w-md max-w-full" />
    </div>

    <div class="w-full max-w-3xl bg-black/40 rounded-2xl p-5">
        <div id="boxGrid" class="grid grid-cols-2 gap-6 md:grid-cols-2 md:grid-rows-4 xl:grid-cols-4 xl:grid-rows-2">
            @foreach($boxes as $i => $boxPrize)
                @php
                    // Sesuaikan dengan eager load: ->with('mysteryBox')
                    $box = $boxPrize->mysteryBox ?? null;
                @endphp

                <div class="mystery-box relative w-full aspect-square flex flex-col items-center justify-end group transition-all duration-200 cursor-pointer"
                     data-index="{{ $i }}">
                    {{-- Badan kotak --}}
                    <img src="{{ $box && $box->bg_back ? asset('storage/' . $box->bg_back) : asset('/assets/img/kotak/kotak.png') }}"
                         class="box-body w-11/12 max-w-[130px] relative z-10" />

                    {{-- Tutup kotak --}}
                    <img src="{{ $box && $box->bg_top ? asset('storage/' . $box->bg_top) : asset('/assets/img/kotak/tutup.png') }}"
                         class="box-lid absolute left-1/2 -translate-x-1/2 top-3 w-11/12 max-w-[130px] transition-all duration-500 shadow-lg z-20" />

                    {{-- Area hadiah (akan diisi dari JS sesuai ticket->prize) --}}
                    <div class="prize hidden absolute inset-0 flex flex-col items-center justify-center text-xl font-bold bg-black/50 m-5 rounded-2xl text-green-600 z-30 pointer-events-none">
                        {{-- Placeholder default (akan dioverwrite JS) --}}
                        <img src="{{ asset('/assets/img/blank-prize.png') }}" alt="Prize" class=" w-32 h-32 mx-auto" />
                        <span class="text-white">???</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Kirim data hadiah tiket dari DB ke JS --}}
<script>
    const ticketPrize = {
        name: @json(optional($ticket->prize)->name ?? '???'),
        image: @json(optional($ticket->prize)->image ? asset('storage/' . $ticket->prize->image) : asset('/assets/img/blank-prize.png'))
    };
</script>

{{-- Shuffle & buka box --}}
<script>
let allowPick = false;
let opened = false;

document.addEventListener('DOMContentLoaded', function () {
    const boxes = Array.from(document.querySelectorAll('.mystery-box'));
    let highlightIdx = -1;
    let count = 0;
    const maxShuffle = 20 + Math.floor(Math.random() * 10);
    const speed = 50;

    function highlight(idx) {
        boxes.forEach((box, i) => {
            if (i === idx) {
                box.classList.add('ring-4', 'ring-yellow-400', 'scale-105', 'shadow-xl');
            } else {
                box.classList.remove('ring-4', 'ring-yellow-400', 'scale-105', 'shadow-xl');
            }
        });
    }

    function shuffle() {
        count++;
        highlightIdx = Math.floor(Math.random() * boxes.length);
        highlight(highlightIdx);
        if (count < maxShuffle) {
            setTimeout(shuffle, speed);
        } else {
            boxes.forEach(box => box.classList.remove('ring-4', 'ring-yellow-400', 'scale-105', 'shadow-xl'));
            allowPick = true;
        }
    }

    shuffle();

    // Buka box sesuai hadiah tiket
    boxes.forEach(box => {
        box.addEventListener('click', function() {
            if (!allowPick || opened) return;
            opened = true;

            const lid = box.querySelector('.box-lid');
            const prizeWrap = box.querySelector('.prize');

            // Isi hadiah berdasarkan DB (ticket->prize)
            if (prizeWrap) {
                let img = prizeWrap.querySelector('img');
                let label = prizeWrap.querySelector('span');

                if (!img) {
                    img = document.createElement('img');
                    img.className = 'w-16 h-16 mx-auto mb-2';
                    prizeWrap.prepend(img);
                }
                if (!label) {
                    label = document.createElement('span');
                    prizeWrap.appendChild(label);
                }

                img.src = ticketPrize.image;
                img.alt = ticketPrize.name || 'Prize';
                label.textContent = ticketPrize.name || '???';
                prizeWrap.classList.remove('hidden');
            }

            // Animasi buka
            lid.style.transform = 'translateY(-70px) rotate(-25deg) scale(1.1)';
            lid.style.opacity = 0.5;

            setTimeout(() => {
                lid.style.display = 'none';
            }, 420);

            // Claim tiket ke backend
            fetch('{{ route('mysterybox.claim', ['code' => $ticket->code]) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).catch(() => {});

            // OPTIONAL: aktifkan jika ingin auto-redirect ke history setelah 2 detik
            // setTimeout(() => {
            //     window.location.href = "{{ route('mysterybox.history', $ticket->code) }}";
            // }, 2000);
        });
    });
});
</script>

{{-- Blokir dasar & deteksi DevTools (refresh 2 detik) --}}
<script>
document.addEventListener('contextmenu', e => e.preventDefault());
document.addEventListener('keydown', e => {
    if (e.key === "F12" ||
        (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
        (e.ctrlKey && e.key === 'U')) {
        e.preventDefault();
    }
});
setInterval(function() {
    const start = performance.now();
    debugger;
    const end = performance.now();
    if (end - start > 100) {
        alert('Developer tools terdeteksi, halaman akan direfresh!');
        setTimeout(function() { location.reload(); }, 2000);
    }
}, 200);
</script>
@endsection
