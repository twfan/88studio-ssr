<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex">
                    <div class="w-1/2 flex flex-col gap-3">
                        <span class="capitalize">Pendapatan perbulan</span>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="w-1/2 flex flex-col gap-3">
                        <span class="capitalize">Total Repeat Order</span>
                        <canvas id="myChartRepeat"></canvas>
                    </div>
                </div>
                <div class="container w-3/4 p-5 mx-auto flex">
                    <div class="w-1/2 flex flex-col gap-3">
                        <span class="capitalize">Total New Order</span>
                        <canvas id="myChartNew"></canvas>
                    </div>
                </div>
                <div class="container w-3/4 p-5 mx-auto flex">
                    <div class="w-full flex flex-col gap-3">
                        <span class="capitalize">Total jumlah pembelian per kategori</span>
                        <canvas id="myChartCategoryBought"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    const ctx = document.getElementById('myChart');
    const ctx2 = document.getElementById('myChartRepeat');
    const ctx3 = document.getElementById('myChartNew');
    const ctx4 = document.getElementById('myChartCategoryBought');
    const data = @json($monthlyTotals);
    const repeatOrder = @json($monthlyTotalsRepeatOrder);
    const newOrder = @json($monthlyTotalNewOrder);
    const categoryNameOrdered = @json($categoryNameOrdered);
    const totalBought = @json($totalBought);

    console.log("categoryNameOrdered", totalBought)

    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: categoryNameOrdered,
            datasets: [{
                label: 'My First Dataset',
                data: totalBought,
                backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],

                borderWidth: 1
            }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'total Sales in USD',
            data: data,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    
    
    new Chart(ctx2, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'total repeat order',
            data: repeatOrder,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    
    new Chart(ctx3, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'total new order',
            data: newOrder,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>
