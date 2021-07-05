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
                    {{$truck}}<br>
                    TYPE = {{$truck->type}}


                    <button onclick="document.getElementById('changeGarageForm').hidden=false;">
                        @if($truck->garage_id==0)
                            Назначить
                        @else
                            Поменять
                        @endif г.</button>
{{--                            <a href="{{route('garages.show',['garage'=>$garage->id])}}" class="underline  text-blue-600 hover:text-gray-900">  {{$garage->id}}, free: {{$garage->freecells()}}</a><br>--}}
                <div hidden="hidden" id="changeGarageForm">
                    <form action="{{route('changeGarage')}}" method="POST">
                        <input type="hidden" name="truck_id" value="{{$truck->id}}">
                        <select name="garage_id">
                            @foreach(Auth::user()->garages as $garage)
                                @if ($garage->freecells())
                                    <option value="{{$garage->id}}">{{$garage}}</option>
                                @endif
                            @endforeach
                        </select>
                        @csrf
                        <button type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="ОК">ок</button>
{{--                    <a href="{{route('trucks.edit',['truck'=>$truck])}}" class="underline  text-blue-600 hover:text-gray-900">--}}
{{--                        <>--}}
{{--                    </a>--}}
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
