<?php

namespace App;
namespace App\models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class suppliersModel extends \Illuminate\Support\Facades\DB
{
    public function getSuppliers()
    {
        try
        {
            $suppliers = DB::select("SELECT * FROM suppliers");
            return $suppliers;
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
