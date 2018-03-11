<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\newUser;
use App\models\login;
use Illuminate\Support\Facades\Session;
            

class loginController extends Controller
{
    public function logUserIn(request $request)
    {
        try
        {            
            $message = array();
            $loginFormResult = array
                    (
                    'username' => $request->email,
                    'password' => $request->password
                    );
            $allUsers = new newUser();
            $allUserResults = $allUsers->getAllUsers();            
            if($allUserResults)
            {
                $login = new login();
                $loginResult = $login->checkUser($loginFormResult, $allUserResults);               
                if($loginResult['loggedIn'] == true)
                {
                    Session::put('loggedIn', $loginResult['loggedIn']);
                    Session::put('name', $loginResult['name']);
                    Session::put('email', $loginResult['email']);
                    Session::put('status', $loginResult['level']);
                    return view('layouts.main', ['loggedIn' => $loginResult]);
                } else
                {
                    Session::put('loggedIn', '0');
                    $message = "<div class='alert alert-danger'>Either your email or password is incorrect.</div>";
                    return view('layouts.login', ['message' => $message]);
                }
            } else 
            {
                $message = '<div class="alert alert-danger">You have no users currently set up in your database.<br>Please contact your system administrator</div>';
                return view('layouts.login', ['message' => $message]);
            }
            
        } catch (Exception $ex) {
               //todo log errors
        }        
    }
    
    public function logOut()
    {
        try
        {
            Session::forget('loggedIn');
            Session::forget('name');
            Session::forget('email');
            Session::flush();
            return view('layouts.login');
        } catch (Exception $ex) {
            
        }
    }
}
