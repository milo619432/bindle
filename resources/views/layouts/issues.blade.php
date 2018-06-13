@extends('layouts.master')
@section('issues')
<div class="container-fluid">
<button type="button" class="btn btn-success" uk-toggle="target: #createIssue" onClick="getAllCusts();getUsers();">Create support ticket</button>
<hr>
<br>
@if(isset ($result))
{!! $result !!}
@endif
<div id="issueTableDiv">
    
</div>
<div id="loader">
    <h3>Fetching issue data</h3>
    <img src="../images/ajax-loader.gif">
</div>
</div>

<!--Create support ticket modal form-->
<div id="modal-close-outside" uk-modal>
    <div id="createIssue" uk-modal class="uk-modal-container">
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Create support ticket</h2>                       
            <form class="uk-grid-small uk-form-horizontal" uk-grid action="{{action('issuesController@addIssue')}}" method="post">
                <div id="issueDrops">
                    <div class="uk-width-1-2@s" id="drops">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">     
                    <label class="uk-form-label" for="form-horizontal-text">Account Code</label>
                        <div class="uk-form-controls">
                            <select name="issueAccount" id="issueCustMenu">
                                <option value="none" selected> -- Please select an account -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s" id="drops">
                    <label class="uk-form-label" for="form-horizontal-text">Assigned to: </label>
                        <div class="uk-form-controls">
                            <select name="assigned" id="assignedTo">
                                <option value="none" selected> --Please select a technician-- </option>
                            </select>
                        </div>
                    </div>
                <br>
                <div class="uk-width-1-2@s" id="drops">
                    <label class="uk-form-label" for="form-horizontal-text">Product</label>
                    <div class="uk-form-controls">
                        <select name="issueType">
                            <option value=""none selected> -- Please select a product: -- </option>
                            <option value="pulseoffice">Pulse Office</option>
                            <option value="pulsestore">Pulse Store</option>
                            <option value="pulsecloud">Pulse Cloud</option>
                            <option valuepulselink>Pulse Link</option>
                        </select>
                    </div>
                </div>                
                <br>                                
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="form-horizontal-text">First date of contact: </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="date" name='date' required>
                    </div>
                </div>
                <br>
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="form-horizontal-text">Ticket time: </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="time" name='firsttime' required>
                    </div>
                </div>                
                <br>
                    <div id="uk-width-1-2@s">
                        <label class="uk-form-label" for="form-horizontal-text">Initial symptoms</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" rows="6" placeholder="symptoms" name='symptoms' ></textarea>
                            </div>
                    </div>
                <br>
                <div id="uk-width-1-2@s">
                    <label class="uk-form-label" for="form-horizontal-text">Resolution</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea" rows="6" placeholder="resolution" name='resolution' ></textarea>
                        </div>
                </div>
                <br>
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="form-horizontal-text">Completion date: </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="date" name='completiondate'>
                    </div>
                </div>
                <br>
                <div id="inputGroup">
                    <input type="submit" class="btn btn-primary" value="Create Issue" onClick="validate();">
                    
                </div>
                </div>
                </div>
            </form>        
        </div>
    </div>
</div>
@endsection