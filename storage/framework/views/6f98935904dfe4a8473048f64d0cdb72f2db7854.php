<?php $__env->startSection('customertable'); ?>
<button type="button" class="btn btn-secondary">Create Customer Account</button>
<button type="button" class="btn btn-secondary">Delete Selected Accounts</button>
<button type="button" class="btn btn-secondary">Suspend Selected Accounts</button>
<hr>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>