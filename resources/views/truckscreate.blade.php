<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('trucks.store')}}" method="Post">
                    @if($isEnoughMoneyToBuyFirstLevelTruck)
                            @csrf
                        <label for="typeSelect">Тип:</label>
                        <select name="type" id="typeSelect">
                            <option value="1">Первый тип</option>
                            <option value="2">Второй тип</option>
                        </select>
                        <label for="name">Name!</label>
                        <?php
                            $truckName = array(
                                'Mercedes', 'Man', 'Iveco', 'Renault', 'Kamaz'
                            );
                            $name = $truckName[array_rand($truckName)];

                        ?>
                        <input type="text" name="name" id="name" value="{{$name}} #{{rand(1,100)}}">
                            <button type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Купить">Купить</button>

                    @else
                        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">Купить</button>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
