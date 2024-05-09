<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    @if (session()->has('success')) 
      <script>
        Swal.fire({
          title: "Create",
          text: "New post has been added!",
          icon: "success"
        });
      </script>
    @endif

    <script>
        function confirmAndDelete() {
          let timerInterval;
          Swal.fire({
            title: "proses delet",
            html: "I will close in <b></b> milliseconds.",
            timer: 300,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            }
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
              }
            });
          }
      </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        
                    <form class="max-w-md mb-10" action="" method="GET">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="query" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>

                        <a href="/crud/produk/create" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 mb-5 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-52 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
                            Create Mobil
                        </a>


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
                                        Harga Sewa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomer Plat
                                    </th>
                                    <th scope="col" class="px-6 py-3 ">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $post)
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
                                            Rp{{ number_format($post['harga_sewa'],0,'.','.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post['nomer_plat'] }}
                                        </td>
                                        <td class="flex" >
                                            <form action="/crud/produk/{{ $post->id }}" method="post" class="">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="confirmAndDelete()" class="text-red-500 ">Delet</button>
                                              </form>
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <p>Notifikasi Peminjaman Users</p>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomer Sim
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomer Telepon
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
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
                                        Tanggal End
                                    </th>
                                    <th scope="col" class="px-6 py-3 ">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $dataAll)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $dataAll->author->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->author->nomer_sim }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->author->alamat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->author->nomer_telepon }}
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->author->email }}
                                            
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $dataAll->merek_mobil }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->model_mobil }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->nomer_plat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp{{ number_format($dataAll->harga_sewa,0,'.','.') }} 
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->tangal_mulai }} 
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $dataAll->tanggal_selesai }} 
                                        </td>
                                        
                                        <td class="text-center flex" >
                                            @if ($dataAll->verifikasi_mobil === 'Padding')
                                            <form action="{{ route('notePeminjamanMobil.update', $dataAll->id_peminjaman) }}" method="post" class="">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="verifikasi_mobil" value="success"> <!-- Ubah 'succes' ke 'success' -->
                                                <button type="submit" class="text-blue-500">Verifikasi Data</button> <!-- Tambahkan type="submit" untuk tombol submit -->
                                            </form>
                                            @elseif($dataAll->verifikasi_mobil === 'success')
                                            <p>succes</p>
                                            @else
                                            {{--  --}}
                                            @endif
                                           
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
