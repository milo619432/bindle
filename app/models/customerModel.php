<?php

namespace App\models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;


class customerModel extends Model
{
    public function addSingleCustomer($details, $contacts)
    {
        try
        {
            if($details)
            {
                print_r($details);
                print_r($contacts);
                die;
            }
        } catch (Exception $ex) {

        }
    }
}
