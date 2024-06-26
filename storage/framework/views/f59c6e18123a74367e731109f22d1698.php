<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Penentuan Jumlah Centroid</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('customers.processClustering')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/clustering_form.blade.php ENDPATH**/ ?>