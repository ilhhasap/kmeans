@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Proses K-Means Clustering</h1>
    <div class="card">
        <div class="card-body">
            @if(isset($iterations) && count($iterations) > 0)
                <h4>Iterasi</h4>
                <div id="accordion">
                    @foreach($iterations as $index => $iteration)
                        <div class="card mb-2">
                            <div class="card-header border" id="heading{{ $index }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        Iterasi {{ $index + 1 }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                                <div class="card-body border">
                                    <h6>Centroid</h6>
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Centroid</th>
                                                <th>Umur</th>
                                                <th>Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($iteration['centroids'] as $i => $centroid)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    @foreach($centroid as $value)
                                                        <td>{{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <h6>Penugasan</h6>
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Data Point</th>
                                                <th>Klaster</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($iteration['assignments'] as $pointIndex => $clusterIndex)
                                                <tr>
                                                    <td>Data Point {{ $pointIndex + 1 }}</td>
                                                    <td>Klaster {{ $clusterIndex + 1 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
