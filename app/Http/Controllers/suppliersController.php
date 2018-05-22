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
            $newSupplierArray = [
                'code' => $request->code,
                'companyName' => $request->companyName,
                'street1' => $request->street1,
                'street2' => $request->street2,
                'town' => $request->town,
                'county' => $request->county,
                'postcode' => $request->postcode,
                'mainphone' => $request->mainphone,
                'fax' => $request->fax,
                'mainemail' => $request->mainemail,
                'comments' => $request->comments
            ];
         
         if($newSupplierArray && sizeof($newSupplierArray) > 0)
         {
             $supplier = new suppliersModel();
             $addSupplierResult = $supplier->addSupplier($newSupplierArray);
             
             if(in_array(false, $addSupplierResult))
             {
                 $resultMessage = "<div class='alert alert-danger' style='text-align:center'>Supplier Creation failed. Please contact a system administrator</div>";
             }
             else
             {
                $resultMessage = "<div class='alert alert-success' style='text-align:center'>Supplier Creation successful. Have a biscuit</div>";
             }
         }
         else
         {
                $resultMessage = "<div class='alert alert-danger' style='text-align:center'>Supplier Creation failed. Please contact a system administrator</div>";
         }
         $allSuppliers = $supplier->getSuppliers();
         
         return view ('layouts.suppliers', ['result' => $resultMessage], ['suppliers' => $allSuppliers]);
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
    
    public function getSingleSupplier()
    {
        try
        {
            $id = $_GET['queryString'];
            $supplier = new suppliersModel();
            $thisSupplier = $supplier->getSingleSupplier($id);
            $singleSuppJSON = json_encode($thisSupplier);
            echo $singleSuppJSON;
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
