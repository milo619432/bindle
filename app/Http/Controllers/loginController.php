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
                if($loginResult['loggedIn'] == true && $loginResult !== false)
                {
                    Session::put('loggedIn', $loginResult['loggedIn']);
                    Session::put('name', $loginResult['name']);
                    Session::put('email', $loginResult['email']);
                    Session::put('status', $loginResult['level']);
                    return view('layouts.main', ['loggedIn' => $loginResult]);
                } elseif($loginResult['live'] == 0)
                {
                    Session::put('loggedIn', '0');
                    $message = "<div style='border: solid 1px red; background-color: #f8d7da'>Your account has been suspended. Contact a system administrator.</div>";
                    return view('layouts.login', ['message' => $message]);
                }
                else
                {
                    Session::put('loggedIn', '0');
                    $message = "<div style='border: solid 1px red; background-color: #f8d7da'>Either your email or password is incorrect.</div>";
                    return view('layouts.login', ['message' => $message]);
                }
            } else 
            {
                $message = "<div style='border: solid 1px red; background-color: #f8d7da'>You have no users currently set up in your database.<br>Please contact your system administrator</div>";
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
