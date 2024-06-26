@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Penentuan Jumlah Centroid</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customers.processClustering') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="clusters">Jumlah Centroid</label>
                    <input type="number" name="clusters" id="clusters" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="max_iterations">Jumlah Iterasi Maksimal</label>
                    <input type="number" name="max_iterations" id="max_iterations" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Mulai Clustering</button>
            </form>
        </div>
    </div>
</div>
@endsection
