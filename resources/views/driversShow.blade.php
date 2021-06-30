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
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Project</th>
                            <th class="py-3 px-6 text-left">Client</th>
                            <th class="py-3 px-6 text-center">Users</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                    @foreach($drivers as $driver)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
{{--                                        <img src="{{asset('characters/'.$character->avatar)}}" width="50%" class="w-6 h-6 rounded-full">--}}
                                    </div>
{{--                                    <span class="font-medium">{{$character->name}}</span>--}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
{{--                                    <span>{{$character->age}}</span>--}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    0
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
{{--                                    @if(!Auth::user()->drivers->where('character_id','=',$character->id)->count())--}}
{{--                                        FREE--}}
{{--                                    @else--}}
{{--                                    BUSY--}}
{{--                                    @endif--}}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
{{--                                    @if(!Auth::user()->drivers->where('character_id','=',$character->id)->count())--}}
{{--                                    <form action="{{route('confirmHireCharacter')}}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="character_id" value="{{$character->id}}">--}}
{{--                                        <button type="submit">  Hire</button>--}}
{{--                                    </form>--}}
{{--                                    @endif--}}
                                </div>
                            </td>
                        </tr>
{{--                   {{$character->id}};--}}
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
