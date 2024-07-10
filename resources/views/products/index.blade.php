<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 mx-auto sm:gap-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Daftar Produk
                    </h3>
                    @if (Auth::user()->role == 'admin')
                    <a href="{{ route('products.create') }}" class="btn btn-outline-gray">
                        &plus; Tambah
                    </a>
                    @endif
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 overflow-x-auto text-gray-800 dark:text-gray-200">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">#</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Name</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Price</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Stock</th>   
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-gray-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($data as $key => $item)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td class="flex items-center justify-start gap-3 px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    <img src="{{ asset($item->image) ?? '-' }}" alt="" class="h-16 rounded-md">
                                                    {{ $item->name }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    Rp. {{ number_format($item->price, 0, '', '.') }},- /satuan
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $item->stock }} Barang
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-blue-400 whitespace-nowrap text-end">
                                                    <div class="flex items-center justify-end gap-1">
                                                        
                                                        @if (Auth::user()->role == 'admin')
                                                        <a href="{{ route('products.show', $item->id) }}" class="!p-1 !text-sm btn btn-text-indigo">Show</a>
                                                        <a href="{{ route('products.edit', $item->id) }}" class="!p-1 !text-sm btn btn-text-amber">Edit</a>
                                                        <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="confirm('Yakin ingin menghapus data?') ? setAttribute('type', 'submit') : ''" class="!p-1 !text-sm btn btn-text-red">Delete</button>
                                                        </form>
                                                        @elseif (Auth::user()->role == 'user')
                                                        <a href="{{ route('user.products.show', $item->id) }}" class="!p-1 !text-sm btn btn-text-indigo">Show</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    Tidak ada data
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-5">
                                    {{ $data->links('pagination::simple-tailwind') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>