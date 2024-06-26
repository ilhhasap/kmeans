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
            <?php $__currentLoopData = $conclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conclusion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($conclusion['cluster']); ?></td>
                <td><?php echo e($conclusion['average_age']); ?></td>
                <td><?php echo e($conclusion['average_income']); ?></td>
                <td><?php echo e($conclusion['count']); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h2>Kesimpulan</h2>
    <?php $__currentLoopData = $conclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conclusion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p>Klaster <?php echo e($conclusion['cluster']); ?> memiliki rata-rata umur <?php echo e($conclusion['average_age']); ?> tahun dan rata-rata pendapatan <?php echo e($conclusion['average_income']); ?>. Jumlah pelanggan dalam klaster ini adalah <?php echo e($conclusion['count']); ?>.</p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/report.blade.php ENDPATH**/ ?>