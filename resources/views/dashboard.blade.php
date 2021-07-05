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
                Период:
                <select name="period" >
                    <option value="day" onclick="location.href='{{route('dashboard',['period'=>'day'])}}'" @if(request()->period=='day') selected @endif>День</option>
                    <option value="month" onclick="location.href='{{route('dashboard',['period'=>'month'])}}'" @if(request()->period=='month') selected @endif>Месяц</option>
                </select>
                <div class="p-6 bg-white border-b border-gray-200">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        const labels = [
            @foreach   ($dates as $date)
                "{{ $date->created_at}}",
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: '',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: {{$values}},
            }]
        };
        const config = {
            type: 'line',
            data,
            options: {}
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
            </div>
        </div>
    </div>
</x-app-layout>
