<?php $__env->startSection('admin'); ?>
<h1>Admin Page</h1>
    <div class="container">            
        <div class="uk-column-2">            
                <div class="row">                    
                    <div class="col">
                        <?php if( isset($result)): ?>
                        <?php echo $result; ?>

                        <?php endif; ?>  
                        <h2>Create new user: </h2>
                        <form class="uk-form-horizontal uk-margin-large" action="<?php echo e(action('newUserController@setNewUser')); ?>" method="post">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" placeholder="First Name" name='firstname' required>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" placeholder="Last Name" name='lastname' required>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">                            
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-horizontal-text">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="password" placeholder="Password" name='pwd' required>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-horizontal-text">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" type="text" placeholder="Email Address" name='email' required>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-horizontal-select">User Permissions</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" name='userlevel'>
                                        <option value='super'>Super Admin</option>
                                        <option value='admin'>Admin</option>
                                        <option value='user'>User</option>
                                    </select>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="save">              
                        </form>
                    </div>
    <div class="col">        
        <?php if(isset($allUsers)): ?>
        <?php if( isset($ammendResult)): ?>
        <?php echo $ammendResult; ?>

        <?php endif; ?>
        <h2>Current Users</h2>
        <table class="uk-table uk-table-hover">        
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Permissions</th>
                </tr>
            </thead>        
            <tbody>
                <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr uk-toggle="target: #editUserModal-<?php echo e($detail->UserID); ?>" id="usersRow" data-firstname ="<?php echo e($detail->firstName); ?>">
                    <td><?php echo e($detail->firstName); ?> <?php echo e($detail->lastName); ?></td>
                    <td><?php echo e($detail->email); ?></td>
                    <td><?php echo e($detail->Status); ?></td>                    
                </tr>
                    <div id="editUserModal-<?php echo e($detail->UserID); ?>" uk-modal>                        
                        <div class="uk-modal-dialog uk-modal-body">
                            <a class="uk-modal-close uk-close" style="float: right">X</a>
                            <h2 class="uk-modal-title"><?php echo e($detail->firstName); ?> <?php echo e($detail->lastName); ?></h2>
                                <form class="uk-form-horizontal uk-margin-large" action="<?php echo e(action('newUserController@editUser')); ?>" method="post">
                                    <div class="uk-margin">
                                        <input hidden="true" value="<?php echo e($detail->UserID); ?>" name="UserID">{
                                        <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="<?php echo e($detail->firstName); ?>" value="<?php echo e($detail->firstName); ?>" name='firstName' required>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="<?php echo e($detail->lastName); ?>" value="<?php echo e($detail->lastName); ?>" name='lastName' required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">                                    
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Password</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="password" placeholder="Enter a new password" value="" name='pwd' required>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Email</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="<?php echo e($detail->email); ?>" value="<?php echo e($detail->email); ?>" name='email' required>
                                        </div>
                                    </div>

                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-select">User Permissions</label>
                                        <div class="uk-form-controls">
                                            <select class="uk-select" name='userlevel'>
                                                <option value='super'>Super Admin</option>
                                                <option value='admin'>Admin</option>
                                                <option value='user'>User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="save">                                                                          
                                </form>
                            
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>        
        <?php else: ?>
        <h2>You currently have no user accounts created</h2>
        <?php endif; ?>
    </div>
  </div>        
</div>
        <hr>
        

   
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('notAllowed'); ?>
<div class="alert alert-danger" role="alert">
    <h3 style='text-align:center'>You do not have access to this page</h3>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>