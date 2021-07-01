<x-app-layout>
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
            <div class="w-full p-3">
                <form action="{{route('assignTruckToDriver')}}" method="POST">
                    @csrf
                    <select name="driver_id">
                        @foreach(Auth::user()->drivers as $driver)
{{--                            {{($truck->driver)}}--}}
                            @if($driver->truck==null)

                                <option value="{{$driver->id}}">
                                    {{$driver->character->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>



                    <input id="idfield" type="hidden" value="" name="truck_id">
                    <button type="submit">OK</button>
                </form>
            </div>

            <!-- footer -->
            <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Save</button>
                <button
                    onclick="openModal(false)"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                >Close</button>
            </div>
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


    <div id="modal_overlay2" class="hidden absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">
        <!-- modal -->
        <div id="modal2" class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            <!-- button close -->
            <button
                onclick="openModal2(false)"
                class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                &cross;
            </button>

            <!-- header -->
            <div class="px-4 py-3 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-600">Title</h2>
            </div>

            <!-- body -->
            <div class="w-full p-3">
                <form action="{{route('assignTruckToDriver')}}" method="POST">
                    @csrf
                    <select name="driver_id">
                        @foreach(Auth::user()->drivers as $driver)
                            {{--                            {{($truck->driver)}}--}}
                            @if($driver->truck==null)

                                <option value="{{$driver->id}}">
                                    {{$driver->character->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>



                    <input id="idfield2" type="hidden" value="" name="truck_id">
                    <button type="submit">OK</button>
                </form>
            </div>

            <!-- footer -->
            <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Save</button>
                <button
                    onclick="openModal2(false)"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                >Close</button>
            </div>
        </div>

    </div>

    <script>
        const modal_overlay2 = document.querySelector('#modal_overlay2');
        const modal2 = document.querySelector('#modal2');

        function openModal2 (value){
            const modalCl2 = modal2.classList
            const overlayCl2 = modal_overlay2
            // document.getElementById("idfield2").value=id;
            if(value){

                overlayCl2.classList.remove('hidden')
                setTimeout(() => {
                    modalCl2.remove('opacity-0')
                    modalCl2.remove('-translate-y-full')
                    modalCl2.remove('scale-150')
                }, 100);
            } else {
                modalCl2.add('-translate-y-full')
                setTimeout(() => {
                    modalCl2.add('opacity-0')
                    modalCl2.add('scale-150')
                }, 100);
                setTimeout(() => overlayCl2.classList.add('hidden'), 300);
            }
        }
    </script>









    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($userCanBuyTruck)

                            <button onclick="openModal2(true); " class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">q
                            </button>

                    @else
                        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">Купить</button>
                    @endif


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
                    @foreach($trucks as $truck)

                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 48 48"
                                             style=" fill:#000000;">
                                            <path fill="#80deea" d="M24,34C11.1,34,1,29.6,1,24c0-5.6,10.1-10,23-10c12.9,0,23,4.4,23,10C47,29.6,36.9,34,24,34z M24,16	c-12.6,0-21,4.1-21,8c0,3.9,8.4,8,21,8s21-4.1,21-8C45,20.1,36.6,16,24,16z"></path><path fill="#80deea" d="M15.1,44.6c-1,0-1.8-0.2-2.6-0.7C7.6,41.1,8.9,30.2,15.3,19l0,0c3-5.2,6.7-9.6,10.3-12.4c3.9-3,7.4-3.9,9.8-2.5	c2.5,1.4,3.4,4.9,2.8,9.8c-0.6,4.6-2.6,10-5.6,15.2c-3,5.2-6.7,9.6-10.3,12.4C19.7,43.5,17.2,44.6,15.1,44.6z M32.9,5.4	c-1.6,0-3.7,0.9-6,2.7c-3.4,2.7-6.9,6.9-9.8,11.9l0,0c-6.3,10.9-6.9,20.3-3.6,22.2c1.7,1,4.5,0.1,7.6-2.3c3.4-2.7,6.9-6.9,9.8-11.9	c2.9-5,4.8-10.1,5.4-14.4c0.5-4-0.1-6.8-1.8-7.8C34,5.6,33.5,5.4,32.9,5.4z"></path><path fill="#80deea" d="M33,44.6c-5,0-12.2-6.1-17.6-15.6C8.9,17.8,7.6,6.9,12.5,4.1l0,0C17.4,1.3,26.2,7.8,32.7,19	c3,5.2,5,10.6,5.6,15.2c0.7,4.9-0.3,8.3-2.8,9.8C34.7,44.4,33.9,44.6,33,44.6z M13.5,5.8c-3.3,1.9-2.7,11.3,3.6,22.2	c6.3,10.9,14.1,16.1,17.4,14.2c1.7-1,2.3-3.8,1.8-7.8c-0.6-4.3-2.5-9.4-5.4-14.4C24.6,9.1,16.8,3.9,13.5,5.8L13.5,5.8z"></path><circle cx="24" cy="24" r="4" fill="#80deea"></circle>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{$truck->name?? 'No name'}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        @if ($truck->driver==null)

                                                <button onclick="openModal(true,{{$truck->id}}); " class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">

                                        @else

                                            <img src="{{asset('characters/'.$truck->driver->character->avatar)}}" width="50%" class="w-6 h-6 rounded-full">
                                        @endif
                                    </div>

                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    {{( $truck->garage->name??'')}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
{{--                            <br><a href="{{route('truck.show',['truck'=>$truck->id])}}" class="underline  text-blue-600 hover:text-gray-900"> Тип: {{$truck->type}}</a><br>--}}
                    @endforeach
                    </tbody>
                </table>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
