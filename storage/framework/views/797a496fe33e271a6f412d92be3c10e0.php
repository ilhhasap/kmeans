<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Add New Customer
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('customers.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="sex">Sex</label>
                    <select name="sex" id="sex" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    <select name="marital_status" id="marital_status" class="form-control">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control">
                </div>
                <div class="form-group">
                    <label for="education">Education</label>
                    <select name="education" id="education" class="form-control">
                        <option value="HighSchool">High School</option>
                        <option value="University">University</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="income">Income</label>
                    <input type="number" name="income" id="income" class="form-control">
                </div>
                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <select name="occupation" id="occupation" class="form-control">
                        <option value="Pekerja Terampil">Pekerja Terampil</option>
                        <option value="Tidak Bekerja">Tidak Bekerja</option>
                        <option value="Wirausaha">Wirausaha</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="settlement_size">Settlement Size</label>
                    <select name="settlement_size" id="settlement_size" class="form-control">
                        <option value="Kota Besar">Kota Besar</option>
                        <option value="Kota Sedang">Kota Sedang</option>
                        <option value="Kota Kecil">Kota Kecil</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhhasap/Documents/Kuliah/Data Mining/kmeans/resources/views/customers/create.blade.php ENDPATH**/ ?>