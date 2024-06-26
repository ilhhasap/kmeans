<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMeans Clustering</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .navbar {
            background-color: transparent;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .container {
            margin-top: 10px;
            padding: 0 10px;
        }
        .card {
            margin-bottom: 20px;
        }
        .stepper {
            display: flex;
            flex-direction: column;
            padding: 30px;
            justify-content: center; /* Menempatkan konten di tengah secara vertikal */
            background-color: #ffffff;
            border-right: 1px solid #e0e0e0;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 320px;
        }
        .stepper .step {
            margin-bottom: 30px;
        }
        .stepper .step a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: block;
            padding: 10px;
            border-radius: 4px;
        }
        .stepper .step a:hover, .stepper .step a.active {
            background-color: #e5f1ff;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">KMeans Clustering</a>
    </nav>
    <div class="stepper">
        <div class="step">
            <a href="<?php echo e(route('customers.index')); ?>" class="<?php echo e(request()->routeIs('customers.index') ? 'active' : ''); ?>">
                1. Dataset
            </a>
        </div>
        <div class="step">
            <a href="<?php echo e(route('customers.showClusteringForm')); ?>" class="<?php echo e(request()->routeIs('customers.showClusteringForm') ? 'active' : ''); ?>">
                2. Penentuan Centroid
            </a>
        </div>
        <div class="step">
            <a href="<?php echo e(route('customers.showProsesKmeans')); ?>" class="<?php echo e(request()->routeIs('customers.showProsesKmeans') ? 'active' : ''); ?>">
                3. Proses KMeans
            </a>
        </div>
        <div class="step">
            <a href="<?php echo e(route('customers.clusteringResult')); ?>" class="<?php echo e(request()->routeIs('customers.clusteringResult') ? 'active' : ''); ?>">
                4. Hasil Clustering
            </a>
        </div>
        <div class="step">
            <a href="<?php echo e(route('customers.visualization')); ?>" class="<?php echo e(request()->routeIs('customers.visualization') ? 'active' : ''); ?>">
                5. Visualization
            </a>
        </div>
        <div class="step">
            <a style="color: red !important;" href="<?php echo e(route('customers.clearClusters')); ?>" class="<?php echo e(request()->routeIs('customers.clearClusters') ? 'active' : ''); ?>">
                Clear Clusters
            </a>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/layouts/app.blade.php ENDPATH**/ ?>