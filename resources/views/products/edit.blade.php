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
                        Edit Produk
                    </h3>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-gray">
                        &larr; Kembali
                    </a>
                </div>
            </div>
            
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 overflow-x-auto text-gray-800 dark:text-gray-200">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <form action="{{ route('products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-12">
                                        <div class="pb-12 border-b border-gray-900/10 dark:border-gray-50/10">
                                            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                                <div class="col-span-full sm:col-span-4">
                                                    <span class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Gambar Produk</span>
                                                    <label class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg cursor-pointer border-gray-900/25 dark:border-gray-100/25">
                                                        <div class="text-center">
                                                            <svg class="w-12 h-12 mx-auto text-gray-300" viewBox="0 0 24 24"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="flex mt-4 text-sm leading-6 text-gray-600 dark:text-gray-400">
                                                                <label for="image"
                                                                    class="relative px-2 font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500 dark:bg-gray-700 dark:text-indigo-300">
                                                                    <span>Upload a file</span>
                                                                    <input id="image" name="image" type="file"
                                                                        class="sr-only">
                                                                </label>
                                                                <p class="pl-2">or click wherever you want</p>
                                                            </div>
                                                            <p class="text-xs leading-5 text-gray-600 dark:text-gray-400">PNG, JPG, JPEG up to 2MB</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="flex justify-center sm:col-span-2 col-span-full">
                                                    <img src="{{ asset($data->image) ?? '-' }}" alt="" class="h-auto rounded-md shadow-lg">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pb-12 border-b border-gray-900/10">
                                            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-5">
                                                <div class="sm:col-span-2">
                                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Nama Produk</label>
                                                    <div class="mt-2">
                                                        <input type="text" value="{{ $data->name }}" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:focus:ring-indigo-600 dark:text-gray-200">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Harga Barang Satuan</label>
                                                    <div class="flex mt-2 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                        <span class="flex items-center px-2 pl-3 text-gray-500 select-none sm:text-sm">Rp.</span>
                                                        <input type="number" value="{{ $data->price }}" name="price" id="price" class="block w-full rounded-md border-0 shadow-sm ring-1 rounded-l-none ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 flex-1 bg-transparent py-1.5 text-gray-900 sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:focus:ring-indigo-600 dark:text-gray-200">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="stock" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Stok Barang</label>
                                                    <div class="mt-2">
                                                        <input type="number" value="{{ $data->stock }}" name="stock" id="stock" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-800 dark:ring-gray-700 dark:focus:ring-indigo-600 dark:text-gray-200">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end gap-x-6">
                                        <a href="{{ route('products.create') }}" class="btn btn-text-gray">Batal</a>
                                        <button type="submit" class="btn btn-indigo !px-7">&check; Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
