@extends('layouts.master')
@section('maindash')

<div class="uk-container uk-container-expand">
    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
    <div >
        <div id="panel" class="uk-card uk-card-default uk-card-body"><i class="fa fa-clock-o" aria-hidden="true"><h3> Total number of calls</h3></i><br><h5 id="totals">0</h5></div>
     </div>
    <div>
        <div id="panel" class="uk-card uk-card-default uk-card-body"><i class="fa fa-hourglass" aria-hidden="true"><h3>Total outstanding issues</h3></i><br><h5 id="outstanding">0</h5></div>
    </div>
    <div>
        <div id="panel" class="uk-card uk-card-default uk-card-body"><i class="fa fa-phone" aria-hidden="true"><h3>Number of calls today</h3></i><br><h5 id="today">0</h5></div>
    </div>
        
</div>
    <div id="issueTableDiv" class="uk-child-width-expand@s uk-text-center" uk-grid uk-height-match="target: > div > .uk-card">
        
</div>


@endsection