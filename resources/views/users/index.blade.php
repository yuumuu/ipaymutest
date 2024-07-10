<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 mx-auto sm:gap-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex items-center justify-between p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Daftar Pengguna
                    </h3>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-gray">
                        &plus; Tambah
                    </a>
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
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Email</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start dark:text-gray-500">Phone</th>
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-500">Role</th>   
                                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end dark:text-gray-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($data as $key => $item)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $item->name }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $item->email }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    {{ $item->phone ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-center text-gray-800 whitespace-nowrap dark:text-gray-200">
                                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium text-indigo-600 rounded-md bg-indigo-50 dark:bg-indigo-800 dark:text-indigo-200 ring-1 ring-inset ring-indigo-500/10">
                                                        {{ $item->role }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-blue-400 whitespace-nowrap text-end">
                                                    <div class="flex items-center justify-end gap-1">
                                                        <a href="{{ route('users.show', $item->id) }}" class="!p-1 !text-sm btn btn-text-indigo">Show</a>
                                                        <a href="{{ route('users.edit', $item->id) }}" class="!p-1 !text-sm btn btn-text-amber">Edit</a>
                                                        <a href="" class="!p-1 !text-sm btn btn-text-red">Delete</a>
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