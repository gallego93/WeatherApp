<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ __('New Registration')}}</h2>
            <form method="POST" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name')}}</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Name')}}" value="{{ old('name') }}">
                    </div>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-5 mt-4 sm:mt-6 rounded">
                    {{ __('Send')}}
                </button>
            </form>
        </div>
    </section>
</x-app-layout>