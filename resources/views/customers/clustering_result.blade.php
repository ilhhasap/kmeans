@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mb-4">Kesimpulan Clustering</h1> <!-- Judul di luar card -->
    <div class="card mb-4">
        <div class="card-body">
            @if($conclusions)
                <div class="row">
                    @foreach($conclusions as $conclusion)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                Klaster {{ $conclusion['cluster'] }}
                            </div>
                            <div class="card-body">
                                <p><strong>Rata-rata Umur:</strong> {{ $conclusion['average_age'] }}</p>
                                <p><strong>Rata-rata Pendapatan:</strong> {{ $conclusion['average_income'] }}</p>
                                <p><strong>Jumlah Pelanggan:</strong> {{ $conclusion['count'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    Tidak ada kesimpulan untuk ditampilkan.
                </div>
            @endif
        </div>
    </div>
<hr>
<h1 class="mb-4">Hasil Clustering</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            @if($clusters->isNotEmpty())
                <h4>Penugasan Klaster</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Pernikahan</th>
                            <th>Umur</th>
                            <th>Pendidikan</th>
                            <th>Pendapatan</th>
                            <th>Pekerjaan</th>
                            <th>Ukuran Pemukiman</th>
                            <th>Klaster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clusters as $cluster)
                        <tr>
                            <td>{{ $cluster->id }}</td>
                            <td>{{ $cluster->sex }}</td>
                            <td>{{ $cluster->marital_status }}</td>
                            <td>{{ $cluster->age }}</td>
                            <td>{{ $cluster->education }}</td>
                            <td>{{ 'Rp ' . number_format($cluster->income, 2, ',', '.') }}</td>
                            <td>{{ $cluster->occupation }}</td>
                            <td>{{ $cluster->settlement_size }}</td>
                            <td>{{ $cluster->cluster }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tambahkan pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $clusters->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-info">
                    Tidak ada data untuk ditampilkan.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
