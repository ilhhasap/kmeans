<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <h1 class="mb-4">Dataset</h1> <!-- Judul di luar card -->
    <div class="card">
        <div class="card-body">
            <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary mb-3">Add New Customer</a>
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
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($customer->id); ?></td>
                        <td><?php echo e($customer->sex); ?></td>
                        <td><?php echo e($customer->marital_status); ?></td>
                        <td><?php echo e($customer->age); ?></td>
                        <td><?php echo e($customer->education); ?></td>
                        <td><?php echo e('Rp ' . number_format($customer->income, 2, ',', '.')); ?></td>
                        <td><?php echo e($customer->occupation); ?></td>
                        <td><?php echo e($customer->settlement_size); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Tambahkan pagination links -->
            <div class="d-flex justify-content-center">
                <?php echo e($customers->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/index.blade.php ENDPATH**/ ?>