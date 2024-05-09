<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman Barang') }}
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
    @if (session()->has('berhasil')) 
      <script>
        Swal.fire({
          title: "Create",
          text: "Success di kembalikan, Terima kasih",
          icon: "success"
        });
      </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        
                        <form class="max-w-md mb-10" action="/peminjamanBarang/search" method="GET">   
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" name="search" value="{{ isset($search) ? $search : '' }}" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                        <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
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
                                            {{ $post['nomer_plat'] }}
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp{{ number_format($post['harga_sewa'],0,'.','.') }}
                                        </td>
                                        <td class="text-center flex" >
                                            @php
                                                $verifikasi_mobil = $peminjaman->where('verifikasi_mobil', $post->nomer_plat)->first();
                                            @endphp
                                            @if ($post->verifikasi_mobil != 'Padding')
                                            <a href="/crud/produk/{{ $post['id']}}/edit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pinjam</a>
                                            @else
                                            <p>Sedang dipakai</p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var query = $(this).val();

            if (query.length > 0) {
                $.ajax({
                    url: "/peminjamanBarang/search",
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        displayResults(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#search-results tbody').empty();
            }
        });

        function displayResults(products) {
            var html = '';

            if (products.length > 0) {
                products.forEach(function(product) {
                    html += '<tr>';
                    html += '<td>' + product.merek_mobil + '</td>';
                    html += '<td>' + product.model_mobil + '</td>';
                    // Tambahkan kolom lain sesuai kebutuhan
                    html += '</tr>';
                });
            } else {
                html = '<tr><td colspan="2">No results found</td></tr>';
            }

            $('#search-results tbody').html(html);
        }
    });
</script>

</x-app-layout>
