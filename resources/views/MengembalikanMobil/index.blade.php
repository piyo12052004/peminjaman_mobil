<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Barang') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <form action="{{ route('returnCar') }}" method="POST">
                            @csrf
                            <label for="nomer_plat">Nomor Plat Mobil:</label>
                            <input type="text" id="nomer_plat" name="nomer_plat">
                            <button type="submit">Kembalikan Mobil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
