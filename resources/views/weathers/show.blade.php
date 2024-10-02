<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weathers')}}
        </h2>
    </x-slot>
    <section class="bg-white">
        <div class="grid grid-cols-5 grid-rows-5 gap-4">
            <div class="col-span-3 col-start-3 row-start-1">
                @include('layouts.map')
            </div>
            <div class="col-start-2 row-start-1">
                <div class="panel-body">
                    <p><strong>{{ __('Registration Date')}}: </strong>{{ $weather->created_at }}</p>
                    <p><strong>{{ __('City')}}: </strong>{{ $weather->city }}</p>
                    <p><strong>{{ __('Temperature')}}: </strong>{{ $weather->temperature }}°C</p>
                    <p><strong>{{ __('Weather Status')}}: </strong><img
                            src="http://openweathermap.org/img/wn/{{ $weather->icon }}@2x.png"
                            style="width: 30px; height: 30px;"> {{ $weather->weather }}</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>