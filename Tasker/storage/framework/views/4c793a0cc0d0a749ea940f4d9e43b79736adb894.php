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

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div><br />
                    <?php endif; ?>

                    <?php if(session()->get('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('success')); ?>

                        </div><br />
                    <?php endif; ?>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">


                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link " href="<?php echo e(url('/home')); ?>">Home </a>
                                    <a class="nav-item nav-link active" href="#">Create A Task <span class="sr-only">(current)</span></a>
                                    <a class="nav-item nav-link" href="#">Task List</a>

                                </div>
                            </div>
                        </nav>






                        <form method="post" action="<?php echo e(route('task.store')); ?>" >
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input type="text" class="form-control" id="inputTitle" aria-describedby="taskTitleHelp" placeholder="Title" name="task_title">

                            </div>
                            <div class="form-group">
                                <label for="inputDetail">Details</label>
                                <input type="text" class="form-control" id="inputDetail" placeholder="Detail" name="task_detail">
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Tasker\resources\views/createTask.blade.php ENDPATH**/ ?>