<?php
namespace App\models;
use Illuminate\Support\Facades\DB;

class login extends \Illuminate\Support\Facades\DB
{
    public function checkUser($formResults, $users)
    {
        if($formResults && $users)
        {
            try
            {
                $user = array(
                    'loggedIn' => 0,
                    'email' => false,
                    'name' => false,
                    'level' => null
                );                
                $userEmail = htmlspecialchars($formResults['username']);
                $userPassword = $formResults['password'];
                
                foreach($users as $k => $v)
                {
                    if($v->email == $userEmail && password_verify($userPassword, $v->HashedPassword))
                    {
                        $user['loggedIn'] = 1;
                        $user['email'] = $v->email;
                        $user['name'] = $v->firstName;
                        $user['level'] = $v->Status;
                        break;
                    }                    
                }
                return $user;
            } catch (Exception $ex) {
                //todo log errors
            }
        }
    }
}