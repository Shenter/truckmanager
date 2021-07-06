<x-app-layout>
    <x-slot name="header">

          <a href="{{route('hireCharacter')}}">
            <button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Hire">
              Нанять водителя
            </button>
          </a>

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
            <form action="{{route('assignTruckToDriver')}}" method="POST">
            <div class="w-full p-3">


        @csrf
        <select name="truck_id">
            @foreach(Auth::user()->trucks as $truck)
                {{--                            {{($truck->driver)}}--}}
                @if($truck->driver==null)

                    <option value="{{$truck->id}}">
                        {{$truck->name}}
                    </option>
                @endif
            @endforeach
        </select>



        <input id="idfield" type="hidden" value="" name="driver_id">
        <button type="submit">OK</button>

            </div>

            <!-- footer -->
            <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none" type="submit">
                    Save
                </button>
                <button
                    onclick="openModal(false)"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
                >Close
                </button>
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Имя</th>
                            <th class="py-3 px-6 text-left">Возраст</th>
                            <th class="py-3 px-6 text-center">Грузовик</th>
                            <th class="py-3 px-6 text-center">Статус</th>
                            <th class="py-3 px-6 text-center">Оконачание рейса</th>
                            <th class="py-3 px-6 text-center">Оплата</th>
                            <th class="py-3 px-6 text-center">Груз</th>
                            <th class="py-3 px-6 text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                    @foreach($drivers as $driver)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="{{asset('characters/'.$driver->character->avatar)}}" width="50%" class="w-6 h-6 rounded-full">
                                    </div>
                                    <span class="font-medium">
                                      <a href="{{route('drivers.show',['driver'=>$driver->id])}}" class="underline  text-blue-600 hover:text-gray-900">
                                      {{$driver->character->name}}
                                    </a>
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$driver->character->age}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="font-medium">{{$driver->truck->name??''}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if ($driver->truck!=null)
                                    @if($driver->hasAJob())
                                        <div class="flex items-center justify-center">
                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">

                                   В пути
                                            </span><img src="{{asset('hasajob.png')}}"   class=" h-6 ">
                                        </div>
                                    @else
                                        @if($driver->searches_a_job)
                                            <span class="bg-blue-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                                Ищет работу
                                            </span>
                                        @else
                                            <span class="bg-yellow-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                                Отдыхает
                                            </span>
                                        @endif
                                    @endif
                                @else
                                    <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                                        Нет грузовика
                                    </span>
                                @endif

                            </td>

                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="font-medium">
                                        @if($driver->hasAJob())
                                            {{date('H:i:s',strtotime($driver->job()->ends_at))}}
                                        @else
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="font-medium">
                                        @if($driver->hasAJob())
                                            {{$driver->job()->cost/100}}
                                        @else
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    {{( $driver->job()->name??'')}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    @if($driver->truck==null)
                                        <button onclick="openModal(true,{{$driver->id}}); " class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">
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
