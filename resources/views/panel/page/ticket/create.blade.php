@extends('panel.partial.main')
@section('title', 'Tambah Tiket')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Tiket</h1>
    <form action="{{ route('ticket.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-md" id="ticketForm">
        @csrf
        <div id="ticketInputs">
            <div class="mb-4 flex items-start gap-2">
                <div class="w-full">
                    <label class="block mb-1 font-semibold">Kode Tiket 1</label>
                    <div class="flex">
                        <input
                            type="text"
                            name="codes[]"
                            id="codeInput0"
                            maxlength="5"
                            class="border rounded-l w-full p-2"
                            required
                        />
                        <button type="button" onclick="generateRandom('codeInput0')" class="bg-gray-200 border border-l-0 rounded-r px-4 flex items-center hover:bg-gray-300" title="Generate kode">
                        <svg width="24px" height="24px" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" fill="#ae00ff" stroke="#ae00ff" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M5.463 4.433A9.961 9.961 0 0 1 12 2c5.523 0 10 4.477 10 10 0 2.136-.67 4.116-1.81 5.74L17 12h3A8 8 0 0 0 6.46 6.228l-.997-1.795zm13.074 15.134A9.961 9.961 0 0 1 12 22C6.477 22 2 17.523 2 12c0-2.136.67-4.116 1.81-5.74L7 12H4a8 8 0 0 0 13.54 5.772l.997 1.795z"></path> </g> </g></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tombol tambah input -->
        <button type="button" id="btnAddInput" class="mb-4 flex items-center gap-2 px-3 py-2 bg-green-100 text-green-700 rounded hover:bg-green-200 focus:outline-none transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
            Tambah Input
        </button>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Pilih Hadiah</label>
            <select name="prize_id" required class="border rounded w-full p-2">
                <option value="">-- Pilih Hadiah --</option>
                @foreach($prizes as $prize)
                    <option value="{{ $prize->id }}" @if(old('prize_id') == $prize->id) selected @endif>{{ $prize->name }}</option>
                @endforeach
            </select>
            @error('prize_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('ticket.index') }}" class="ml-4 text-gray-700">Kembali</a>
    </form>
</div>

<script>
let inputCount = 1;
function randomString(length) {
    let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}
function generateRandom(inputId) {
    document.getElementById(inputId).value = randomString(5);
}

document.getElementById('btnAddInput').onclick = function() {
    inputCount++;
    let container = document.getElementById('ticketInputs');
    let newDiv = document.createElement('div');
    newDiv.className = "mb-4 flex items-start gap-2";
    newDiv.innerHTML = `
        <div class="w-full">
            <label class="block mb-1 font-semibold">Kode Tiket ${inputCount}</label>
            <div class="flex">
                <input
                    type="text"
                    name="codes[]"
                    id="codeInput${inputCount-1}"
                    maxlength="5"
                    class="border rounded-l w-full p-2"
                    required
                />
                <button type="button" onclick="generateRandom('codeInput${inputCount-1}')" class="bg-gray-200 border border-l-0 rounded-r px-4 flex items-center hover:bg-gray-300" title="Generate kode">
                     <svg width="24px" height="24px" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" fill="#ae00ff" stroke="#ae00ff" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M5.463 4.433A9.961 9.961 0 0 1 12 2c5.523 0 10 4.477 10 10 0 2.136-.67 4.116-1.81 5.74L17 12h3A8 8 0 0 0 6.46 6.228l-.997-1.795zm13.074 15.134A9.961 9.961 0 0 1 12 22C6.477 22 2 17.523 2 12c0-2.136.67-4.116 1.81-5.74L7 12H4a8 8 0 0 0 13.54 5.772l.997 1.795z"></path> </g> </g></svg>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newDiv);
}
</script>
@endsection
