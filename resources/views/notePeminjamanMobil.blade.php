<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">    
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Merek Mobil
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Model Mobil
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nomer Plat
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Harga Sewa
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal Start
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal end
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Harga Sewa
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Ket
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration }}
                                            </th>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ Str::limit( $post->merek_mobil,100) }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ Str::limit( $post->model_mobil,100) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$post['nomer_plat']}}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp{{ number_format($post['harga_sewa'],0,'.','.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <p id="start_date">{{$post['tangal_mulai']}}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                               <p id="end_date"> {{ $post['tanggal_selesai'] }}</p>
                                            </td>

                                            @php
                                                // Ambil tanggal dari variabel atau dari data yang ada
                                                $tanggalMulai = \Carbon\Carbon::createFromFormat('Y-d-m', $post['tangal_mulai']);
                                                $haristart = $tanggalMulai->day;
                                                $tanggalSelesai = \Carbon\Carbon::createFromFormat('Y-d-m', $post['tanggal_selesai']);
                                                $harilast = $tanggalSelesai->day;
                                                $kurangiHari =  $harilast -$haristart;
                                                $totalBiaya = $kurangiHari * $post['harga_sewa'] + $post['harga_sewa'] ;
                                            @endphp
                                            <td class="px-6 py-4">
                                                Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($post->verifikasi_mobil == 'success')
                                                <p>Silahkan Ambil Barang Pinjaman Nya</p>
                                                 @else
                                                 <p>Silahkan tunggu</p>
                                                @endif
                                            </td>
                                            <td class="text-center flex" >
                                                 @if($post->verifikasi_mobil === 'success')
                                                 <p class="mx-2 text-green-600">succes</p>
                                                 <a href=" /MengembalikanMobil" class="text-yellow-300 text-center">mengembalikan mobile</a>
                                                 @else
                                                 <p>padding</p>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> 
                           </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Static modal
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </div>
    </div>




    

</x-app-layout>
