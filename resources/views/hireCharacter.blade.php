<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div id="modal_overlay" class="hidden absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

        <!-- modal -->
        <div id="modal" class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

            <!-- button close -->
            <button
                onclick="openModal(false)"
                class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-600">Title</h2>
            </div>

            <!-- body -->
            <form action="{{route('confirmHireCharacter')}}" method="POST">
            <div class="w-full p-3">

                    @csrf
                    <select name="truck_id">
                    @foreach(Auth::user()->trucks as $truck)
                            {{($truck->driver)}}
                        @if($truck->driver==null)

                            <option value="{{$truck->id}}">
                            {{$truck->name}}
                            </option>
                        @endif
                    @endforeach
                    </select>



                    <input id="idfield" type="hidden" value="" name="character_id">


            </div>

            <!-- footer -->
            <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none" type="submit">Save</button>
                <button
                    onclick="openModal(false)"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                >Close</button>
            </div>
        </form>
        </div>

    </div>

    <script>
        const modal_overlay = document.querySelector('#modal_overlay');
        const modal = document.querySelector('#modal');

        function openModal (value,id){
            const modalCl = modal.classList
            const overlayCl = modal_overlay
            document.getElementById("idfield").value=id;
            if(value){

                overlayCl.classList.remove('hidden')
                setTimeout(() => {
                    modalCl.remove('opacity-0')
                    modalCl.remove('-translate-y-full')
                    modalCl.remove('scale-150')
                }, 100);
            } else {
                modalCl.add('-translate-y-full')
                setTimeout(() => {
                    modalCl.add('opacity-0')
                    modalCl.add('scale-150')
                }, 100);
                setTimeout(() => overlayCl.classList.add('hidden'), 300);
            }
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <font color="red">
                {{$errors->first()}}
            </font>
            </div>
            @endif
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
                    @foreach($characters as $character)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="{{asset('characters/'.$character->avatar)}}" width="50%" class="w-6 h-6 rounded-full">
                                    </div>
                                    <span class="font-medium">{{$character->name}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{$character->age}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    0
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                    @if(!Auth::user()->drivers->where('character_id','=',$character->id)->count())
                                        FREE
                                    @else
                                    BUSY
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    @if(!Auth::user()->drivers->where('character_id','=',$character->id)->count())
{{--                                    <form action="{{route('confirmHireCharacter')}}" method="POST">--}}
                                        <button onclick="openModal(true,{{$character->id}}); " class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">
                                            Open Modal
                                        </button>
{{--                                    </form>--}}
                                    @endif
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
