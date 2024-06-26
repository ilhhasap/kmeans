@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Clustering Result</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cluster</th>
                <th>Centroid</th>
                <th>Iterations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clusters as $cluster)
            <tr>
                <td>{{ $cluster['cluster'] }}</td>
                <td>{{ implode(', ', $cluster['centroid']) }}</td>
                <td>{{ $cluster['iterations'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection