@extends('layouts.master')
@section('customertable')
<div class="container-fluid">
<button type="button" class="btn btn-success" uk-toggle="target: #createSupplier">Create supplier Account</button>
<hr>
<br>
@if(isset ($result))
{!! $result !!}
@endif
<div id="suppTableDiv">
    
</div>
<div id="loader">
    <h3>Fetching Supplier Data</h3>
    <img src="../images/ajax-loader.gif">
</div>
</div>



<!--Create customer modal form-->
<div id="modal-close-outside" uk-modal>
    <div id="createSupplier" uk-modal class="uk-modal-container">
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Supplier Form</h2>            
            <div class="alert alert-danger" id="requiredFields" hidden>
                <p>The following fields are required before the account can be created.</p>
            </div>
            <form class="uk-grid-small uk-form-horizontal" uk-grid action="{{action('suppliersController@addSupplier')}}" method="post">                
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
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
                        </div>
                    
                <br>
                <input type="submit" class="btn btn-primary" value="save" onClick="validate();">              
            </form>        
        </div>
    </div>
</div>

@endsection