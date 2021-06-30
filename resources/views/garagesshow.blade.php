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
                    @if($userCanBuyGarage)
                        <form action="{{route('garages.store')}}" method="post">
                            @csrf

                            <button type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Купить">Купить</button>
                        </form>
                    @else
                        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">Купить</button>
                    @endif

                    @foreach($garages as $garage)
                            <a href="{{route('garages.show',['garage'=>$garage->id])}}" class="underline  text-blue-600 hover:text-gray-900">  {{$garage->id}}, free: {{$garage->freecells()}}</a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
