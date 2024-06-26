@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="mb-4">Dataset</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sex</th>
                        <th>Marital Status</th>
                        <th>Age</th>
                        <th>Education</th>
                        <th>Income</th>
                        <th>Occupation</th>
                        <th>Settlement Size</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->sex }}</td>
                        <td>{{ $customer->marital_status }}</td>
                        <td>{{ $customer->age }}</td>
                        <td>{{ $customer->education }}</td>
                        <td>{{ 'Rp ' . number_format($customer->income, 2, ',', '.') }}</td>
                        <td>{{ $customer->occupation }}</td>
                        <td>{{ $customer->settlement_size }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tambahkan pagination links -->
            <div class="d-flex justify-content-center">
                {{ $customers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
