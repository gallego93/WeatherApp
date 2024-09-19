<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            @can('weathers.create')
                <a href="{{ route('weathers.create') }}">
                    <button class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{{ __('New Registration')}}</button>
                </a>
            @endcan
            <form action="{{ route('weathers.index') }}" method="GET">
                <input class="rounded px-2 py-1" name="search" value="{{ request('search') }}" placeholder=" {{ __('Search')}} ">
                <button type="submit"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white rounded "> {{ __('Search')}} </button>
            </form>
            <form action="{{ route('weathers.index') }}" method="GET" class="flex items-center">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="field" value="{{ request('field') }}">

                <label for="per_page"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ __('Records per page:')}}</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <button type="submit"
                    class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{{ __('Apply')}}</button>
            </form>
        </div>
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('City')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Temperature')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Weather Status')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Registration Date')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Query Type')}}
                    </th>
                    @can('weathers.show')
                        <th scope="col" class="px-6 py-3">
                            {{ __('Show')}}
                        </th>
                    @endcan
                    @can('weathers.delete')
                        <th scope="col" class="px-6 py-3">
                            {{ __('Delete')}}
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($weathers as $row)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $row->city }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $row->temperature }}°C
                        </td>
                        <td class="px-6 py-4">
                            <img src="http://openweathermap.org/img/wn/{{ $row->icon }}@2x.png"
                                style="width: 50px; height: 50px;"> {{ $row->weather }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $row->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $row->type }}
                        </td>
                        @can('weathers.show')
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('weathers.show', $row->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Show')}}</a>
                            </td>
                        @endcan
                        @can('weathers.delete')
                            <td class="px-6 py-4 text-right">
                                <form method="post" action="{{ route('weathers.destroy', $row->id) }}">
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
        <div class="mt-4">
            {{ $weathers->appends(request()->except('page'))->links() }}
        </div>
        @if ($weathers->isEmpty())
            <p>{{ __('There are no records.')}}</p>
        @endif
    </div>
</x-app-layout>
