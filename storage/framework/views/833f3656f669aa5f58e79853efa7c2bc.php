<?php $__env->startSection('content'); ?>
<div class="container">
<h1 class="mb-4">Kesimpulan Clustering</h1> <!-- Judul di luar card -->
    <div class="card mb-4">
        <div class="card-body">
            <?php if($conclusions): ?>
                <div class="row">
                    <?php $__currentLoopData = $conclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conclusion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                Klaster <?php echo e($conclusion['cluster']); ?>

                            </div>
                            <div class="card-body">
                                <p><strong>Rata-rata Umur:</strong> <?php echo e($conclusion['average_age']); ?></p>
                                <p><strong>Rata-rata Pendapatan:</strong> <?php echo e($conclusion['average_income']); ?></p>
                                <p><strong>Jumlah Pelanggan:</strong> <?php echo e($conclusion['count']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Tidak ada kesimpulan untuk ditampilkan.
                </div>
            <?php endif; ?>
        </div>
    </div>
<hr>
<h1 class="mb-4">Hasil Clustering</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            <?php if($clusters->isNotEmpty()): ?>
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
                        <?php $__currentLoopData = $clusters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cluster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($cluster->id); ?></td>
                            <td><?php echo e($cluster->sex); ?></td>
                            <td><?php echo e($cluster->marital_status); ?></td>
                            <td><?php echo e($cluster->age); ?></td>
                            <td><?php echo e($cluster->education); ?></td>
                            <td><?php echo e('Rp ' . number_format($cluster->income, 2, ',', '.')); ?></td>
                            <td><?php echo e($cluster->occupation); ?></td>
                            <td><?php echo e($cluster->settlement_size); ?></td>
                            <td><?php echo e($cluster->cluster); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <!-- Tambahkan pagination links -->
                <div class="d-flex justify-content-center">
                    <?php echo e($clusters->links('pagination::bootstrap-4')); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/clustering_result.blade.php ENDPATH**/ ?>