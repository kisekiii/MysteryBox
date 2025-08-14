@extends('mysterybox.partial.main')
@section('title', 'Cek Tiket Mystery Box')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen"
     style="background: url('{{ $setting && $setting->background
        ? asset('storage/' . $setting->background)
        : asset('/assets/img/back/bg-default.jpg') }}') center center / cover no-repeat fixed;">
    <div class="w-full max-w-sm">
        {{-- Klaim Hadiah (form input tiket) --}}
        <div class="mb-8 text-center">
            <img
                src="{{ $setting && $setting->icon ? asset('storage/'.$setting->icon) : asset('/assets/img/logo/logo-sub.png') }}"
                alt="{{ $setting->site_name ?? 'Logo-sub' }}"
                class="mx-auto w-52 xl:w-md max-w-full"
            />
        </div>
        <form action="{{ route('mysterybox.check') }}" method="POST"
              class="bg-white shadow-md rounded-xl px-8 py-6 m-5">
            @csrf
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ticket_code">
                Masukkan Kode Tiket
            </label>
            <input type="text" name="ticket_code" id="ticket_code" placeholder="Kode Tiket"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500"
                   required autofocus>
            @error('ticket_code')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <button type="submit"
                    class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                KLAIM
            </button>
        </form>

        <div class="mb-6 text-center">
            <a href="{{ route('mysterybox.allprizes') }}"
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-6 rounded-xl shadow transition block text-center mt-2">
                Cek Hadiah
            </a>
        </div>

        <div id="boxGrid" class="grid grid-cols-2 gap-6 md:grid-cols-2 md:grid-rows-4 xl:grid-cols-4 xl:grid-rows-2"
            style="display:none;">
            @foreach($prizes as $i => $prize)
            <div class="mystery-box w-full aspect-square flex items-center justify-center bg-transparent relative transition-all duration-200"
                data-index="{{ $i }}">
                <img src="/assets/img/kotak/kotak.png"
                    class="box-body w-11/12 max-w-[130px] relative z-0" />
                <div class="prize absolute inset-0 flex flex-col items-center justify-center text-xl font-bold bg-black/30 m-5
                rounded-2xl text-green-600 z-30 pointer-events-none">
                    <img src="{{ $prize->image }}" alt="Prize" class="w-16 h-16 mx-auto mb-2" />
                    <span>{{ $prize->name }}</span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Error msg --}}
        @if(session('error'))
            <div class="text-red-500 text-center mt-4">{{ session('error') }}</div>
        @endif
    </div>
</div>

<script>
    // Ketika tombol cek hadiah diklik
    document.getElementById('showAllBtn').addEventListener('click', function() {
        document.getElementById('boxGrid').style.display = 'grid';
        // Scroll ke grid hadiah agar user lihat langsung
        document.getElementById('boxGrid').scrollIntoView({ behavior: 'smooth' });
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
