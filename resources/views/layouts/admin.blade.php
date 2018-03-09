@extends('layouts.master')
@section('admin')
<h1>Admin Page</h1>
    <div class="container">            
        <div class="uk-column-2">            
                <div class="row">                    
                    <div class="col">
                        @if( isset($result))
                        {!! $result !!}
                        @endif  
                        <h2>Create new user: </h2>
                        <form class="uk-form-horizontal uk-margin-large" action="{{action('newUserController@setNewUser')}}" method="post">
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
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
        @if(isset($allUsers))
        @if( isset($ammendResult))
        {!! $ammendResult !!}
        @endif
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
                @foreach($allUsers as $users => $detail)
                <tr uk-toggle="target: #editUserModal-{{$detail->UserID}}" id="usersRow" data-firstname ="{{ $detail->firstName }}">
                    <td>{{ $detail->firstName }} {{ $detail->lastName }}</td>
                    <td>{{ $detail->email }}</td>
                    <td>{{ $detail->Status }}</td>                    
                </tr>
                    <div id="editUserModal-{{$detail->UserID}}" uk-modal>                        
                        <div class="uk-modal-dialog uk-modal-body">
                            <a class="uk-modal-close uk-close" style="float: right">X</a>
                            <h2 class="uk-modal-title">{{ $detail->firstName}} {{$detail->lastName}}</h2>
                                <form class="uk-form-horizontal uk-margin-large" action="{{action('newUserController@editUser')}}" method="post">
                                    <div class="uk-margin">
                                        <input hidden="true" value="{{$detail->UserID}}" name="UserID">
                                        <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="{{$detail->firstName}}" value="{{$detail->firstName}}" name='firstName' required>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="{{$detail->lastName}}" value="{{$detail->lastName}}" name='lastName' required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Password</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="password" placeholder="Enter a new password" value="" name='pwd' required>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="form-horizontal-text">Email</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" type="text" placeholder="{{$detail->email}}" value="{{$detail->email}}" name='email' required>
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
                            <button class='btn btn-danger' href="">Delete User</button>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>        
        @else
        <h2>You currently have no user accounts created</h2>
        @endif
    </div>
  </div>        
</div>
        <hr>
        

   
    </div>
@endsection
@section('notAllowed')
<div class="alert alert-danger" role="alert">
    <h3 style='text-align:center'>You do not have access to this page</h3>
</div>
@endsection