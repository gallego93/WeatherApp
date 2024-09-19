<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            @can('users.create')
                <a href="{{ route('users.create') }}">
                    <button class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{{ __('New')}}</button>
                </a>
            @endcan
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('User Name')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Email')}}
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Default City')}}
                    </th>
                    @can('users.edit')
                        <th scope="col" class="px-6 py-3">
                            {{ __('Edit')}}
                        </th>
                    @endcan
                    @can('users.delete')
                        <th scope="col" class="px-6 py-3">
                            {{ __('Delete')}}
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $row)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $row->name }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $row->user_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $row->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $row->default_city }}
                        </td>
                        @can('users.edit')
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('users.edit', $row->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Edit')}}</a>
                            </td>
                        @endcan
                        @can('users.delete')
                            <td class="px-6 py-4 text-right">
                                <form method="post" action="{{ route('users.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        {{ __('Delete')}}
                                    </button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($users->isEmpty())
            <p>{{ __('There are no records.')}}</p>
        @endif
    </div>
</x-app-layout>
