@extends('layouts.master')
@section('customertable')
<button type="button" class="btn btn-secondary" uk-toggle="target: #createCustomer">Create Customer Account</button>
<button type="button" class="btn btn-secondary">Delete Selected Accounts</button>
<button type="button" class="btn btn-secondary">Suspend Selected Accounts</button>
<hr>
<!--Create customer modal form-->
<div id="modal-close-outside" uk-modal>
    <div id="createCustomer" uk-modal class="uk-modal-container">
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Customer Form</h2>
            <p class="uk-text-meta uk-text-primary">The fields on ALL tabs must be filled in or the submit button will remain disabled.</p>
            <form class="uk-grid-small" uk-grid action="" method="post">
                <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                    <li><a href="#">Customer Information</a></li>
                    <li><a href="#">System Information</a></li>
                    <li><a href="#">Customer Contact Details</a></li>
                    <li><a href="#">licensing and Account Information</a></li>
                </ul>
                <ul class="uk-switcher uk-margin"   style="width: 100%">
                    <li>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Account Code</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Code" name='code' required>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Company Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-form-width-large" type="text" placeholder="Company Name" name='companyName' required>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Street 1</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="password" placeholder="Street 1" name='street1' required>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Street 2</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Street 2" name='street2' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Town</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Town" name='town' required>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">County</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="County" name='county' required>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Postcode</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Postcode" name='postcode' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Main Phone</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Main Phone" name='mainphone' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Fax</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" placeholder="Fax" name='fax' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Main Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="email" placeholder="Main Email" name='mainemail' >
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Comments</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Comments" name='comments' ></textarea>
                            </div>
                        </div>   
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Install Date</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='install' >
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Hosted Pulse?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='hosted'>
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Stock?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='stock' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">PulseStore?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='pulseStore' >
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Special Upgrade Requirements</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Upgrade requirements" name='upgradeNotes' ></textarea>
                            </div>
                        </div>
                    </li>
                    <li>3</li>
                    <li>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Licence Expiry Date</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='expiry' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">On hold?</label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name='onhold' >
                            </div>
                        </div>
                        <div class="uk-width-1-4@s">
                            <label class="uk-form-label" for="form-horizontal-text">Date paid until</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="date" placeholder="date" name='paidto' >
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-horizontal-text">Licence Notes</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="Licence Notes" name='licenceNotes' ></textarea>
                            </div>
                        </div>                
                    </li>
                </ul>             
                <br>
                <input type="submit" class="btn btn-primary" value="save" disabled>              
            </form>        
        </div>
    </div>
</div>
@endsection