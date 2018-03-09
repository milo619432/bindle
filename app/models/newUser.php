<?php

namespace App\models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class newUser extends \Illuminate\Support\Facades\DB
{
    /*
     * Fetch all users from DB
     */
    public function getAllUsers()
    {
        try
        {
            $results = DB::select('SELECT * FROM heartuser');
            return $results;
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    /*
     * insert new user to db
     */
    public function addUser($user)
    {        
        if($user)
        {
            try
            {
                $CreatedTime = date("Y-m-d h:i:sa");
                $hashedPassword = \Hash::make($user['password']);
                
                $results = DB::insert('INSERT INTO heartuser (firstName ,lastName, email, HashedPassword, CreatedTime ,Status)'
                . ' values (?, ?, ?, ?, ?, ?)', [
                    $user['firstName'],
                    $user['lastName'], 
                    $user['email'],
                    $hashedPassword,
                    $CreatedTime, 
                    $user['permissions']
                        ]);
                    if($results && true == $results)
                    {
                        return $results;
                    }
                    else 
                    {
                        return false;
                    }
            } catch (Exception $ex) {
                //todo log error
            }
        }
        
    }
    
    //edit existing user
    public function editUser($user)
    {
        try
        {
            $hashedPassword = \Hash::make($user['password']);
            $result = DB::update('UPDATE heartuser SET firstName = "' . $user['firstName'] .
                    '", lastName = "' . $user['lastName'] . 
                    '", email = "' . $user['email'] . 
                    '", HashedPassword = "' . $hashedPassword . 
                    '", Status = "' . $user['permissions'] . 
                    '" WHERE UserID = ' . $user['ID'] . ' LIMIT 1'
                    );
            if($result && true == $result)
            {
                Session::put('name', $user['firstName']);
                Session::put('email', $user['email']);
                Session::put('status', $user['permissions']);
                return $result;
            }
            else 
            {
                return false;
            }
            
        } catch (Exception $ex) {
            //todo log error
        }
    }
}