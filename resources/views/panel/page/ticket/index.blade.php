@extends('panel.partial.main')
@section('title', 'Dashboard')
@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Daftar Tiket Kupon
              </h2>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Kupon hadiah untuk Mystery Box.
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                   href="{{ route('ticket.index') }}">
                  Lihat Semua
                </a>

                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700"
                   href="{{ route('ticket.create') }}">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Tambah Tiket
                </a>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-900">
              <tr>
                <th scope="col" class="ps-6 py-3 text-start">
                  #
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Kode Tiket
                  </span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Hadiah
                  </span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Status
                  </span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Dibuat
                  </span>
                </th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
              @forelse($tickets as $ticket)
              <tr>
                <td class="ps-6 py-3">
                  {{ (($tickets->currentPage() - 1) * $tickets->perPage()) + $loop->iteration }}
                </td>
                <td class="px-6 py-3 font-mono flex items-center gap-2">
                    <span id="code-{{ $ticket->id }}">{{ $ticket->code }}</span>
                    <button type="button"
                        onclick="copyToClipboard('{{ $ticket->code }}', this)"
                        class="p-1 rounded hover:bg-gray-200 dark:hover:bg-neutral-700"
                        title="Copy">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"/>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                        </svg>
                    </button>
                </td>
                <td class="px-6 py-3">{{ $ticket->prize->name ?? '-' }}</td>
                <td class="px-6 py-3">
                  @if($ticket->claimed_at)
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-500/10 dark:text-green-400">
                      <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><path fill="currentColor" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.02l-3.47 4.42-2.09-2.09a.75.75 0 0 0-1.06 1.06l2.62 2.62a.75.75 0 0 0 1.08-.02l3.99-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                      Claimed
                    </span>
                  @else
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-600/10 dark:text-yellow-400">
                      <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8" fill="currentColor"/><path stroke="#fff" stroke-width="2" d="M8 4v4l2 2"/></svg>
                      Belum Claim
                    </span>
                  @endif
                </td>
                <td class="px-6 py-3 text-sm text-gray-500 dark:text-neutral-400">
                  {{ $ticket->created_at->format('d M Y, H:i') }}
                </td>
                <td class="px-6 py-3 font-mono flex items-center gap-2">

                <!-- Tombol edit -->
                <a href="{{ route('ticket.edit', $ticket->id) }}" title="Edit"
                class="p-1 rounded hover:bg-yellow-200 dark:hover:bg-yellow-700">
                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15.232 5.232l3.536 3.536M9 13l6-6M2 20h7l11-11a2.828 2.828 0 0 0-4-4L5 16v4z"/>
                    </svg>
                </a>

                <!-- Tombol hapus -->
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus tiket ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" title="Hapus"
                        class="p-1 rounded hover:bg-red-200 dark:hover:bg-red-700">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 6h18M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M19 6V4a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2"/>
                        </svg>
                    </button>
                </form>
            </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-gray-500 dark:text-neutral-400">Belum ada tiket.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer / Pagination -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
            <div>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $tickets->total() }}</span> hasil
              </p>
            </div>

            <div>
              <!-- Laravel pagination (rapi) -->
              {{ $tickets->onEachSide(1)->links('pagination::tailwind') }}
            </div>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<div id="toast-copy" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 px-6 py-3 rounded-lg bg-black text-white text-sm shadow-lg opacity-0 pointer-events-none transition-all duration-300">
    Ticket sudah di salin!
</div>
<script>
function copyToClipboard(code, btn) {
    navigator.clipboard.writeText(code).then(function() {
        btn.classList.add('bg-green-100');
        btn.querySelector('svg').classList.remove('text-gray-400');
        btn.querySelector('svg').classList.add('text-green-500');
        setTimeout(() => {
            btn.classList.remove('bg-green-100');
            btn.querySelector('svg').classList.remove('text-green-500');
            btn.querySelector('svg').classList.add('text-gray-400');
        }, 1000);
    });
}
</script>
<script>
function copyToClipboard(code, btn) {
    navigator.clipboard.writeText(code).then(function() {
        // Animasi button
        btn.classList.add('bg-green-100');
        btn.querySelector('svg').classList.remove('text-gray-400');
        btn.querySelector('svg').classList.add('text-green-500');
        setTimeout(() => {
            btn.classList.remove('bg-green-100');
            btn.querySelector('svg').classList.remove('text-green-500');
            btn.querySelector('svg').classList.add('text-gray-400');
        }, 800);

        // Tampilkan toast
        let toast = document.getElementById('toast-copy');
        toast.classList.remove('opacity-0', 'pointer-events-none');
        toast.classList.add('opacity-100');
        setTimeout(() => {
            toast.classList.add('opacity-0', 'pointer-events-none');
            toast.classList.remove('opacity-100');
        }, 1200);
    });
}
</script>

@endsection
