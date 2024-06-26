@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Visualisasi Hasil Clustering</h1>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Jumlah Data Points per Klaster</h3>
                    <p class="card-text">Grafik ini menunjukkan jumlah data points yang ada di setiap klaster.</p>
                    <canvas id="clusteringChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Distribusi Umur dan Pendapatan</h3>
                    <p class="card-text">Grafik ini menunjukkan distribusi umur dan pendapatan dari setiap klaster. Setiap titik merepresentasikan satu data point.</p>
                    <canvas id="scatterChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Kesimpulan Klaster</h3>
                    <p class="card-text">Grafik ini menunjukkan distribusi jumlah data points per klaster dalam bentuk persentase.</p>
                    <canvas id="pieChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Points dan Klaster</h3>
                    <p class="card-text">Tabel ini menunjukkan data points dan klaster yang sesuai. Anda dapat memfilter dan menyortir data.</p>
                    <div class="mb-3">
                    <a href="{{ route('customers.downloadReport') }}" class="btn btn-success mb-3 {{ $hasClusters ? '' : 'disabled' }}">Download Report</a>
                    </div>
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Umur</th>
                                <th>Pendapatan</th>
                                <th>Klaster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataPoints as $dataPoint)
                            <tr>
                                <td>{{ $dataPoint->id }}</td>
                                <td>{{ $dataPoint->age }}</td>
                                <td>{{ $dataPoint->income }}</td>
                                <td>{{ $dataPoint->cluster }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clusteringCtx = document.getElementById('clusteringChart').getContext('2d');
        const scatterCtx = document.getElementById('scatterChart').getContext('2d');
        const pieCtx = document.getElementById('pieChart').getContext('2d');

        const clusters = @json($clusters);
        const dataPoints = @json($dataPoints);

        // Data untuk Bar Chart
        const barLabels = clusters.map(cluster => `Klaster ${cluster.cluster}`);
        const barData = clusters.map(cluster => cluster.total);

        new Chart(clusteringCtx, {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Jumlah Data Points per Klaster',
                    data: barData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Data Points'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Klaster'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        // Data untuk Scatter Chart
        const scatterColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        const scatterBorderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ];

        const scatterData = clusters.map((cluster, index) => {
            const clusterPoints = dataPoints.filter(point => point.cluster === cluster.cluster);
            return {
                label: `Klaster ${cluster.cluster}`,
                data: clusterPoints.map(point => ({ x: point.age, y: point.income })),
                backgroundColor: scatterColors[index % scatterColors.length],
                borderColor: scatterBorderColors[index % scatterBorderColors.length],
                borderWidth: 1,
                pointRadius: 5
            };
        });

        new Chart(scatterCtx, {
            type: 'scatter',
            data: {
                datasets: scatterData
            },
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Umur'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Pendapatan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Umur: ${context.raw.x}, Pendapatan: ${context.raw.y}`;
                            }
                        }
                    }
                }
            }
        });

        // Data untuk Pie Chart
        const pieLabels = clusters.map(cluster => `Klaster ${cluster.cluster}`);
        const pieData = clusters.map(cluster => cluster.total);

        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieData,
                    backgroundColor: scatterColors,
                    borderColor: scatterBorderColors,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        // Initialize DataTable
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Data Points'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Data Points'
                }
            ]
        });

        // Event listener for export buttons
        $('#exportCSV').on('click', function() {
            $('#dataTable').DataTable().button('.buttons-csv').trigger();
        });

        $('#exportExcel').on('click', function() {
            $('#dataTable').DataTable().button('.buttons-excel').trigger();
        });
    });
</script>
@endsection
