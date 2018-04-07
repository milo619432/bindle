<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\suppliersModel;

class suppliersController extends Controller
{
    public function addSupplier(request $request)
    {
        try
        {
            
        } catch (Exception $ex) {

        }
    }
    
    public function getSuppliers()
    {
        try
        {
            
            $suppliers = new suppliersModel();
            $allSuppliers = $suppliers->getSuppliers();
            if(sizeof($allSuppliers) > 0)
            {
                $suppliersJSON = json_encode($allSuppliers);
                echo $suppliersJSON;
            }
            else
            {
                $errorJSON = json_encode("No suppliers Found");
                echo $errorJSON;
                //do something else
            }
        } catch (Exception $ex) {

        }
    }
}
