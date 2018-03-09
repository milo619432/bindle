<?php $__env->startSection('admin'); ?>
<h1>Admin Page</h1>
    <div>
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
        <li><a href='#'>Users Admin</a></li>
        <li><a href='#'>Data Imports</a></li>
        <li><a href='#'>Database Admin</a></li>
    </ul>

    <ul class='uk-switcher' uk-switcher>
        <div class="uk-column-2">
            <li>
                <div class="row">
    <div class="col">
      <form class="uk-form-horizontal uk-margin-large">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">First Name</label>
                    <div class="uk-form-controls">
                        <input required="" class="uk-input" type="text" placeholder="First Name" name='firstname'>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Last Name</label>
                    <div class="uk-form-controls">
                        <input required="" class="uk-input" type="text" placeholder="Last Name" name='lastname'>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">User Name</label>
                    <div class="uk-form-controls">
                        <input required="" class="uk-input" type="text" placeholder="UserName" name='username'>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Password</label>
                    <div class="uk-form-controls">
                        <input required="" class="uk-input" type="password" placeholder="Password" name='pwd'>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Email</label>
                    <div class="uk-form-controls">
                        <input required="" class="uk-input" type="text" placeholder="Email Address" name='email'>
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
                <button class="uk-button uk-button-danger">Submit</button>               

            </form>
    </div>
    <div class="col">
      <h2>Current Users</h2>
      <table class="uk-table uk-table-hover">        
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Permissions level</th>
                <th>Delete</th>
            </tr>
        </thead>        
        <tbody>
            <tr>
                <td>Table Data</td>
                <td>Table Data</td>
                <td>Table Data</td>
                <td><button class="uk-button-danger">Delete</button></td>
            </tr>
            <tr>
                <td>Table Data</td>
                <td>Table Data</td>
                <td>Table Data</td>
                <td><button class="uk-button-danger">Delete</button></td>
            </tr>
        </tbody>
    </table>
    </div>
  </div>
            
            
        </li>
        </div>
        
        <li>
            <label class="btn btn-primary" for="my-file-selector">
    <input id="my-file-selector" type="file" style="display:none;">
    Button Text Here
</label>
        </li>
        <li>WOOOOOOOOOOO</li>
    </ul>
    </div>
   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>