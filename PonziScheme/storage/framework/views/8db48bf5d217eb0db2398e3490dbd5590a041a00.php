<?php if(Session::has('success')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success:</strong> <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error:</strong> <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('status')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('status')); ?>

    </div>
<?php endif; ?>