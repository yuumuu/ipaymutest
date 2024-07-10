<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 mx-auto sm:gap-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Histori Transaksi
                    </h3>
                    @if (Auth::user()->role == 'user')
                    <a href="{{ route('user.products.index') }}" class="btn btn-outline-gray">
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
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Product</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Quantity</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Price</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Invoice</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Status</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Payment Method</th>
                                                @if (Auth::user()->role == 'admin')
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Customer</th>
                                                @endif
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Created At</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-gray-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($data as $key => $item)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td class="flex items-center justify-start gap-3 px-6 py-4 text-sm text-gray-800 dark:text-gray-200 min-w-52">
                                                    <img src="{{ asset($item->product->image) ?? '-' }}" alt="" class="h-16 rounded-md">
                                                    {{ $item->product->name }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $item->quantity }}
                                                    <span class="text-xs">Buah</span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 min-w-52">
                                                    <span class="text-xs">Rp.</span>
                                                    {{ number_format($item->total_price, 0, '', '.') }},-
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 truncate max-w-60 dark:text-gray-200">
                                                    {{ $item->invoice }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 uppercase select-none dark:text-gray-200">
                                                    @if ($item->status == 'success')
                                                    <span class="inline-flex shadow items-center px-2 py-0.5 text-xs font-medium text-emerald-600 rounded-md bg-emerald-50 dark:bg-emerald-800 dark:text-emerald-200 ring-1 ring-inset ring-emerald-500/10">
                                                        {{ $item->status }}
                                                    </span>
                                                    @elseif ($item->status == 'pending')
                                                    <span class="inline-flex shadow items-center px-2 py-0.5 text-xs font-medium text-yellow-600 rounded-md bg-yellow-50 dark:bg-yellow-800 dark:text-yellow-200 ring-1 ring-inset ring-yellow-500/10">
                                                        {{ $item->status }}
                                                    </span>
                                                    @elseif ($item->status == 'expired')
                                                        <span class="inline-flex shadow items-center px-2 py-0.5 text-xs font-medium text-red-600 rounded-md bg-red-50 dark:bg-red-800 dark:text-red-200 ring-1 ring-inset ring-red-500/10">
                                                        {{ $item->status }}
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 uppercase select-none dark:text-gray-200">
                                                    <span class="inline-flex shadow items-center px-2 py-0.5 text-xs font-medium text-indigo-600 rounded-md bg-indigo-50 dark:bg-indigo-800 dark:text-indigo-200 ring-1 ring-inset ring-indigo-500/10">
                                                        {{ $item->payment_method }}
                                                    </span>
                                                </td>
                                                @if (Auth::user()->role == 'admin')
                                                <td class="px-6 py-4 text-xs text-gray-800 dark:text-gray-200">
                                                    {{ $item->user->name }}
                                                </td>
                                                @endif
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                    <div class="flex flex-col items-start justify-center">
                                                    <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                                    <span class="text-xs text-ray-600 dark:text-gray-400">{{ date('H:i:s', strtotime($item->created_at)) }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-blue-400 text-end">
                                                    <div class="flex items-center justify-end gap-1">
                                                        
                                                        @if (Auth::user()->role == 'admin')
                                                        <a href="{{ route('transactions.show', $item->id) }}" class="!p-1 !text-sm btn btn-text-indigo">Show</a>
                                                        <form action="{{ route('transactions.destroy', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="confirm('Yakin ingin menghapus data?') ? setAttribute('type', 'submit') : ''" class="!p-1 !text-sm btn btn-text-red">Delete</button>
                                                        </form>
                                                        @elseif (Auth::user()->role == 'user')
                                                        <a href="{{ route('user.transactions.show', $item->id) }}" class="!p-1 !text-sm btn btn-text-indigo">Show</a>
                                                        @if ($item->status !== 'success')
                                                        <a href="{{ $item->payment_url }}" class="!py-1 !text-sm btn btn-indigo">Bayar</a>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="px-6 py-4 text-sm text-center text-gray-800 dark:text-gray-200">
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