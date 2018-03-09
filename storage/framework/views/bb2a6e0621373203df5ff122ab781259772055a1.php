<?php $__env->startSection('customertable'); ?>
<button type="button" class="btn btn-secondary" uk-toggle="target: #createCustomer">Create Customer Account</button>
<button type="button" class="btn btn-secondary">Delete Selected Accounts</button>
<button type="button" class="btn btn-secondary">Suspend Selected Accounts</button>
<hr>
<!--Create customer modal form-->
<div id="modal-close-outside" uk-modal>
    <div id="createCustomer" uk-modal class="uk-modal-container">
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Customer Form</h2>
            <form class="uk-form-horizontal uk-margin-large" action="" method="post">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Account Code</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Code" name='code' required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Company Name</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Company Name" name='companyName' required>
                    </div>
                </div>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">                            
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Street 1</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="password" placeholder="Street 1" name='street1' required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Street 2</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Street 2" name='street2' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Town</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Town" name='town' required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">County</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="County" name='county' required>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Postcode</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Postcode" name='postcode' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Main Phone</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Main Phone" name='mainphone' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Fax</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" placeholder="Fax" name='fax' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Main Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="email" placeholder="Main Email" name='mainemail' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Licence Expiry Date</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="date" placeholder="date" name='expiry' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Date paid until</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="date" placeholder="date" name='paidto' >
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">On hold?</label>
                    <div class="uk-form-controls">
                        <input class="uk-checkbox" type="checkbox" name='onhold' >
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>