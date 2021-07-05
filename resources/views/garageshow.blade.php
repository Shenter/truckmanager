<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session()->has('success'))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <font color="green">

                        {{ session()->get('success') }}
                    </font>
                </div><br>
            @endif
            @if($errors->any())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <font color="red">
                    {{$errors->first()}}
                </font>
            </div>
                    <br>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    {{$garage}}<br>
                    FREE = {{$garage->freecells()}}
                    @if($garage->level<5)
                        <form action="{{route('upgradeGarage',['garage'=>$garage->id])}}" method="POST">
                            @csrf
                            <input type="submit" value="Upgr">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
