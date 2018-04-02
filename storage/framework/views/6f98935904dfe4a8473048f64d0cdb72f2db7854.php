<?php $__env->startSection('customertable'); ?>
<div class="container-fluid">
<button type="button" class="btn btn-success" uk-toggle="target: #createCustomer">Create Customer Account</button>
<button type="button" class="btn btn-danger">Delete Selected Accounts</button>
<button type="button" class="btn btn-danger">Suspend Selected Accounts</button>
<hr>
<br>
<form action="<?php echo e(action('customerController@importCustomers')); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
<input type="file" id="file" name="file" hidden="true" accept=".csv" onchange='form.submit()'/>
<label for="file" class="btn btn-secondary" >Choose a Customer import file</label>
</form>
<?php if(isset ($result)): ?>
<?php echo $result; ?>

<?php endif; ?>
<div id="custTableDiv">
    
</div>
<div id="loader">
    <h3>Fetching Customer Data</h3>
    <img src="../images/ajax-loader.gif">
</div>
</div>



<!--Create customer modal form-->
<div id="modal-close-outside" uk-modal>
    <div id="createCustomer" uk-modal class="uk-modal-container">
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Customer Form</h2>            
            <div class="alert alert-danger" id="requiredFields" hidden>
                <p>The following fields are required before the account can be created.</p>
            </div>
            <form class="uk-grid-small uk-form-horizontal" uk-grid action="<?php echo e(action('customerController@addSingleCustomer')); ?>" method="post">
                <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                    <li><a href="#">Customer Information</a></li>
                    <li><a href="#">System Information</a></li>
                    <li><a href="#">Customer Contact Details</a></li>
                    <li><a href="#">Accounts Information</a></li>
                    <li><a href="#">Wholesaler Link Information</a>
                </ul>
                <ul class="uk-switcher uk-margin"   style="width: 100%">
                    <li>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Account Code</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Code" name='code' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Company Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Company Name" name='companyName' required>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">                            
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Street 1</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Street 1" name='street1' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Street 2</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Street 2" name='street2' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Town</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Town" name='town' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">County</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="County" name='county' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Postcode</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Postcode" name='postcode' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Main Phone</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Main Phone" name='mainphone' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Fax</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Fax" name='fax' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Main Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="email" placeholder="Main Email" name='mainemail' required>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Comments</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Comments" name='comments' ></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Install Date</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='install' >
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Hosted Pulse?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='hosted'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Stock?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='stock' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseStore?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='pulseStore' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Terminal Server?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='terminalserver' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseOffice Version #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="PulseOffice Version #" name='pulseVersion'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">OPXML PC</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="OPXML PC" name='opxmlpc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Sage PC</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Sage PC" name='sagepc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseLink PC</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="PulseLink PC" name='pulselinkpc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Sage Version #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Sage Version #" name='sagenum'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseStore Shop #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="PulseStore Shop #" name='pulsestorenumber'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseStore Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="PulseStore Password" name='pulsestorepassword'>
                            </div>
                        </div>
                        <br>                        
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Special Upgrade Requirements</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Upgrade requirements" name='upgradeNotes' ></textarea>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Network Details</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Network Details" name='network' ></textarea>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="First Name" name='conFirstName0'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Last Name" name='conLastName0'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Phone</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Phone Number" name='conPhoneNumber0'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="email" placeholder="Email" name='conEmail0'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Main Contact?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='conMain0' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-horizontal-select">Select Main Role</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" name='conRoleChoice0'>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div id="additionalContacts"></div>
                        <a href='#' onclick="moreContactFields();">Add More Contacts?</a>
                    </li>
                    <li>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Licence Expiry Date</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='expiry'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Licence To Date</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='licenceToDate'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">On hold?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='onhold' >
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Date paid until</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='paidto'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Licence Notes</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Licence Notes" name='licenceNotes' ></textarea>
                            </div>
                        </div>                
                    </li>
                    <li>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Vow Account #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Vow Account #" name='vowacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Vow Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Vow Password" name='vowpass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Vow Discount %</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="number" min="0" max="100" placeholder="Vow Discount" name='vowdisc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Spicer Account #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Spicers Account #" name='spicacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Spicers Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Spicers Password" name='spicpass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Antalis Account #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Antalis Account #" name='antacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Antalis Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Antalis Password" name='antpass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Truline Account #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Truline Account #" name='truacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Truline Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Truline Password" name='trupass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Beta Account</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Beta Account" name='betaacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Beta Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Beta Password" name='betapass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Exertis Account #</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Exertis Account #" name='exertacc'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text" >Exertis Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Exertis Password" name='exertpass'>
                            </div>
                        </div>
                        <br>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Buying Group</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Buying Group" name='buyinggroup'>
                            </div>
                        </div>                        
                    </li>
                </ul>             
                <br>
                <input type="submit" class="btn btn-primary" value="save" onClick="validate();">              
            </form>        
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>