<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Водитель</th>
                                <th class="py-3 px-6 text-center">Сумма</th>
                                <th class="py-3 px-6 text-center">Статус</th>
                                <th class="py-3 px-6 text-center">?</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">
                                        <a href="{{route('drivers.show',['driver'=>$order->driver])}}"  class="underline  text-blue-600 hover:text-gray-900">
                                        {{optional($order->driver)->character->name??''}}
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    {{round($order->cost/100,2) ??''}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    @if ($order->is_active==1)
                                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                                        Выполняется
                                        </span>

                                    @else
                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                    Выполнен
                                         </span>
                                    @endif
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
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                            </tbody>
                        </table>
                    <br>
                    {{$orders->links()}}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
