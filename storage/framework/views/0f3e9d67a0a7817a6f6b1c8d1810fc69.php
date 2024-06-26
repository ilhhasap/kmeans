<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Proses K-Means Clustering</h1>
    <div class="card">
        <div class="card-body">
            <?php if(isset($iterations) && count($iterations) > 0): ?>
                <h4>Iterasi</h4>
                <div id="accordion">
                    <?php $__currentLoopData = $iterations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $iteration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-2">
                            <div class="card-header border" id="heading<?php echo e($index); ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse<?php echo e($index); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($index); ?>">
                                        Iterasi <?php echo e($index + 1); ?>

                                    </button>
                                </h5>
                            </div>

                            <div id="collapse<?php echo e($index); ?>" class="collapse" aria-labelledby="heading<?php echo e($index); ?>" data-parent="#accordion">
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
                                            <?php $__currentLoopData = $iteration['centroids']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $centroid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($i + 1); ?></td>
                                                    <?php $__currentLoopData = $centroid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><?php echo e($value); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php $__currentLoopData = $iteration['assignments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pointIndex => $clusterIndex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>Data Point <?php echo e($pointIndex + 1); ?></td>
                                                    <td>Klaster <?php echo e($clusterIndex + 1); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Tidak ada data untuk ditampilkan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/proses_kmeans.blade.php ENDPATH**/ ?>