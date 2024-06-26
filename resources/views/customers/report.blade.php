<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysis Report</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        h1, h2, h3, p {
            margin: 0 0 10px 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>Analysis Report</h1>
    <h2>Kesimpulan Clustering</h2>
    <table>
        <thead>
            <tr>
                <th>Klaster</th>
                <th>Rata-rata Umur</th>
                <th>Rata-rata Pendapatan</th>
                <th>Jumlah Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conclusions as $conclusion)
            <tr>
                <td>{{ $conclusion['cluster'] }}</td>
                <td>{{ $conclusion['average_age'] }}</td>
                <td>{{ $conclusion['average_income'] }}</td>
                <td>{{ $conclusion['count'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h2>Kesimpulan</h2>
    @foreach($conclusions as $conclusion)
    <p>Klaster {{ $conclusion['cluster'] }} memiliki rata-rata umur {{ $conclusion['average_age'] }} tahun dan rata-rata pendapatan {{ $conclusion['average_income'] }}. Jumlah pelanggan dalam klaster ini adalah {{ $conclusion['count'] }}.</p>
    @endforeach
</body>
</html>
