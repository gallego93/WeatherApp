<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            @can('permissions.create')
            <a href="{{ route('permissions.create') }}">
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
                    @can('permissions.edit')
                    <th scope="col" class="px-6 py-3">
                        {{ __('Edit')}}
                    </th>
                    @endcan
                    @can('permissions.delete')
                    <th scope="col" class="px-6 py-3">
                        {{ __('Delete')}}
                    </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row->name }}
                    </th>
                    @can('permissions.edit')
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('permissions.edit', $row->id) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Edit')}}</a>
                    </td>
                    @endcan
                    @can('permissions.delete')
                    <td class="px-6 py-4 text-right">
                        <form method="post" action="{{ route('permissions.destroy', $row->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Delete')}}
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($permissions->isEmpty())
        <p>{{ __('There are no records.')}}</p>
        @endif
    </div>
</x-app-layout>