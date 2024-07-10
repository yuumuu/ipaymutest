<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    @if (session('message') || (Auth::user()->role == 'user' && !Auth::user()->phone))
        <div class="w-full pt-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 border-l-4 text-amber-700 bg-amber-100 border-amber-500" role="alert">
                    <p class="font-bold">Be Warned</p>
                    <p>
                        Lengkapi nomor HP anda terlebih dahulu di halaman
                        <a class="btn-text-amber !text-amber-500" href="{{ route('profile.edit') }}">Profile</a>
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="grid grid-cols-1 mx-auto sm:gap-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Detail Produk
                    </h3>
                    <div class="flex items-center justify-end gap-2">
                        @if (Auth::user()->role == 'admin')
                        <a href="{{ route('products.index') }}" class="btn btn-outline-gray">
                            &larr; Kembali
                        </a>
                        <a href="{{ route('products.edit', $data->id) }}" class="btn btn-gray">
                            Edit &rarr;
                        </a>
                        @elseif (Auth::user()->role == 'user')
                        <a href="{{ route('user.products.index') }}" class="btn btn-outline-gray">
                            &larr; Kembali
                        </a>
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'transaction')"
                        >{{ __('Buat Transaksi') }}</x-primary-button>

                        <x-modal name="transaction" :show="$errors->transaction->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('user.transactions.store') }}" class="p-6" x-data="{ quantity: 1, price: {{ $data->price }}, totalPrice: {{ $data->price }} }" x-init="$watch('quantity', value => totalPrice = value * price)">
                                @csrf
                        
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Buat Transaksi') }}
                                </h2>
                        
                                <input type="hidden" name="product_id" value="{{ $data->id }}" class="hidden">
                        
                                <div class="mt-6">
                                    <x-input-label for="quantity" value="{{ __('Jumlah (maksimal 5.000.000 Rupiah)') }}" />
                        
                                    <div class="flex items-center justify-center gap-3 mx-auto">
                                        <button type="button" @click="quantity > 1 ? quantity-- : quantity" class="text-xl btn btn-indigo">
                                            &minus;
                                        </button>

                                        <style>
                                            input[type=number]#quantity::-webkit-inner-spin-button,
                                            input[type=number]#quantity::-webkit-outer-spin-button {
                                                -webkit-appearance: none;
                                                margin: 0;
                                            }
                                        </style>
                        
                                        <x-text-input
                                            id="quantity"
                                            name="quantity"
                                            type="number"
                                            class="block w-1/5 mt-1 text-xl text-center"
                                            min="1"
                                            max="{{ $data->stock }}"
                                            x-model="quantity"
                                            required
                                        />
                                        <x-input-error :messages="$errors->transaction->get('quantity')" class="mt-2" />
                                        
                                        <button type="button" @click="quantity < {{ $data->stock }} ? quantity++ : quantity" class="text-xl btn btn-indigo">
                                            &plus;
                                        </button>
                                    </div>
                                </div>
                        
                                <div class="mt-6">
                                    <x-input-label for="total_price" value="{{ __('Total Harga') }}" />
                        
                                    <x-text-input
                                        id="total_price"
                                        name="total_price"
                                        type="number"
                                        class="block w-full mt-1"
                                        x-bind:value="totalPrice"
                                        required
                                        readonly
                                    />
                                    <x-input-error :messages="$errors->transaction->get('total_price')" class="mt-2" />
                                </div>
                        
                                <div class="mt-6">
                                    <x-input-label for="payment_method" value="{{ __('Metode Pembayaran (sementara baru bisa ipaymu)') }}" />
                                    <div class="grid grid-cols-3 gap-3 mt-1" x-data="{ paymentMethod: '' }">
                                        <label :class="paymentMethod === 'ipaymu' ? 'border-indigo-600 ring-2 ring-indigo-500' : 'border-gray-300 dark:border-gray-300'" class="inline-flex items-center justify-center py-3 border rounded-lg cursor-pointer px-7 hover:border-indigo-600">
                                            <img src="" alt="">
                                            <span class="m-3 text-gray-900 dark:text-gray-100">Ipaymu</span>
                                            <input
                                                type="radio"
                                                id="ipaymu"
                                                name="payment_method"
                                                value="ipaymu"
                                                class="hidden"
                                                required
                                                x-model="paymentMethod"
                                            />
                                        </label>
                                        <label :class="paymentMethod === 'midtrans' ? 'border-indigo-600 ring-2 ring-indigo-500' : 'border-gray-300 dark:border-gray-300'" class="inline-flex items-center justify-center py-3 border rounded-lg cursor-pointer px-7 hover:border-indigo-600">
                                            <img src="" alt="">
                                            <span class="m-3 text-gray-900 dark:text-gray-100">Midtrans</span>
                                            <input
                                                type="radio"
                                                id="midtrans"
                                                name="payment_method"
                                                value="midtrans"
                                                class="hidden"
                                                required
                                                x-model="paymentMethod"
                                            />
                                        </label>
                        
                                        <label :class="paymentMethod === 'xendit' ? 'border-indigo-600 ring-2 ring-indigo-500' : 'border-gray-300 dark:border-gray-300'" class="inline-flex items-center justify-center py-3 border rounded-lg cursor-pointer px-7 hover:border-indigo-600">
                                            <img src="" alt="">
                                            <span class="m-3 text-gray-900 dark:text-gray-100">Xendit</span>
                                            <input
                                                type="radio"
                                                id="xendit"
                                                name="payment_method"
                                                value="xendit"
                                                class="hidden"
                                                required
                                                x-model="paymentMethod"
                                            />
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->transaction->get('payment_method')" class="mt-2" />
                                </div>
                        
                                <div class="flex justify-end mt-6">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                        
                                    <x-primary-button class="ms-3">
                                        {{ __('Buat Transaksi') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-modal>
                        
                        @endif
                    </div>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 overflow-x-auto text-gray-800 dark:text-gray-200">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <dl class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                                            Nama Produk
                                        </dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                            {{ $data->name }}
                                            <img src="{{ asset($data->image) }}" alt="" class="mt-3 rounded-md shadow-lg" />
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                                            Harga Satuan Barang
                                        </dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                            Rp. {{ number_format($data->price, 0, '', '.') }},-
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                                            Stok Barang
                                        </dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                            {{ $data->stock }} Buah
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
