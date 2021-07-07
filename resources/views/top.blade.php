<x-app-layout>
    <x-slot name="header">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    Ваше место  - {{$currentUserPlace}}<br>

                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">№</th>
                            <th class="py-3 px-6 text-left">Имя</th>
                            <th class="py-3 px-6 text-left">Заработано</th>

                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
        <? $i=1?>
                    @foreach($usersStat as $stat)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">
                                       {{$i++}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">
                                       {{$stat->name}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        {{ $stat->sum/100}}
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

            </div>
        </div>
    </div>
</x-app-layout>
