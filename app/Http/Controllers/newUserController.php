<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\newUser;

class newUserController extends Controller
{
    /*
     * Fetch users tpo populate table on admin page
     */
    public function getUsers()
    {       
        try
        {
            $allUsers = new newUser();
            $allUsersResult = $allUsers->getAllUsers();
            //dd(sizeof($allUsersResult));
            if(sizeof($allUsersResult) > 0)
            {
                return view('layouts.admin', ['allUsers' => $allUsersResult]);
            }
            else
            {
                return view('layouts.admin');
            }
            
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    /*
     * Add users to DB
     */
    public function setNewUser(request $request)
    {        
        try
        {
            $newUserDetails = [
            'firstName' => $request->firstname,
            'lastName' => $request->lastname,            
            'password' => $request->pwd,
            'email' => $request->email,
            'permissions' => $request->userlevel
            ];
            $users = new newUser();
            $newUserResult = $users->addUser($newUserDetails);
            if(true == $newUserResult)
            {
                $resultMessage = "<div class='alert alert-success' style='text-align:center'>New User added successfully</div>";
            }
            else 
            {
                $resultMessage = "<div class='alert alert-danger'>New User not added</div>";
            }
            $allUsersResult = $users->getAllUsers();
            return view('layouts.admin', ['result' => $resultMessage], ['allUsers' => $allUsersResult]);
        } catch (Exception $ex) {
            //todo log errors
        }       
    }
    
    public function editUser(request $request)
    {
        try
        {
            $ammendedDetails = [
                'ID' => $request->UserID, 
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'password' => $request->pwd,
                'email' => $request->email,
                'permissions' => $request->userlevel
            ];
            $user = new newUser();
            $userResult = $user->editUser($ammendedDetails);
            if(true == $userResult)
            {
                $ammendedMessage = "<div class='alert alert-success' style='text-align:center'>User successfully amended</div>";
            }
            else 
            {
                $ammendedMessage = "<div class='alert alert-danger' style='text-align:center'>User ammendment failed</div>";
            }
            $allUsersResult = $user->getAllUsers();
            return view('layouts.admin', ['ammendResult' => $ammendedMessage], ['allUsers' => $allUsersResult]);
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function deleteUser($user)
    {
        try
        {
            die('Gone bitches');
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
