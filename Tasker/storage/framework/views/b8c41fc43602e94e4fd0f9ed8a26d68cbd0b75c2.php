<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"  ><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">




                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                                    <a class="nav-item nav-link" href="<?php echo e(route('task.index')); ?>">Create A Task</a>


                                </div>
                            </div>
                        </nav>




                        <div class="text-center">

                        <!--this line is alternative of start and end tag of php with echo 'You are logged in! inside' -->

                            <?php echo e(__('You are logged in!')); ?>




                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Tasker\resources\views/home.blade.php ENDPATH**/ ?>