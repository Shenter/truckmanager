<x-app-layout>
    <x-slot name="header">

          @if($userCanBuyGarage)
              Стоимость покупки гаража - {{config('garages.first_level_cost') /100}}$
              <form action="{{route('garages.store')}}" method="post">
                  @csrf

                  <button type="submit"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" value="Купить">Купить</button>
              </form>
          @else
              <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">
                Купить гараж
              </button>
          @endif

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Гараж</th>
                                <th class="py-3 px-6 text-left">Вместимость</th>
                                <th class="py-3 px-6 text-center">Свободных мест</th>
                                <th class="py-3 px-6 text-center">Водители</th>
                                <th class="py-3 px-6 text-center">Действия</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                    @foreach($garages as $garage)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium"> <a href="{{route('garages.show',['garage'=>$garage->id])}}" class="underline  text-blue-600 hover:text-gray-900">  {{$garage->name}}</a><br></span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        {{$garage->level}}

                                    </div>

                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                    {{$garage->freecells()}}

                            </td>

                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                @foreach($garage->trucks as $trucks)
                                    @if($trucks->driver)
                                        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125" src="{{asset('characters/'.$trucks->driver->character->avatar)}}"/>
                                    @endif
                                @endforeach
                                </div>
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
                                        <form action="{{route('garages.destroy',['garage'=>$garage->id])}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="red" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
