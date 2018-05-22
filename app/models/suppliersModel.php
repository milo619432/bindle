<?php

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
    
    public function getSingleSupplier($id)
    {
        try
        {
            $resultMessage = [
                'status' => null,
                'message' => null
                
            ];
            if($id)
            {
                $supplier = DB::select("SELECT * FROM suppliers WHERE suppID = " . $id . ";");
            } else
            {
                $resultMessage['message'] = "No ID supplied";
            }
                if(sizeof($supplier) > 0)
                {
                    return $supplier;
                } 
                else 
                {
                    return $resultMessage;
                }
            
        } catch (Exception $ex) {
            //todo log error
        }
    }
    
    public function addSupplier($newSupplier)
    {
        try
        {
            //results details to return to controller
            $result = 
            [
                'status' => null,
                'message' => null
            ];
            
            $insertResult = DB::insert('INSERT INTO suppliers (code, '
                    . 'name, '
                    . 'street1, '
                    . 'street2, '
                    . 'town, '
                    . 'county, '
                    . 'postcode, '
                    . 'mainPhone, '
                    . 'fax, '
                    . 'mainEmail, '
                    . 'comments) '
                    . 'values (?,?,?,?,?,?,?,?,?,?,?)', 
                    [
                        $newSupplier['code'],
                        $newSupplier['companyName'], 
                        $newSupplier['street1'],
                        $newSupplier['street2'],
                        $newSupplier['town'],
                        $newSupplier['county'],
                        $newSupplier['postcode'],
                        $newSupplier['mainphone'],
                        $newSupplier['fax'],
                        $newSupplier['mainemail'],
                        $newSupplier['comments']
                    ]);
            
            if($insertResult && true == $insertResult)
            {
                $result['status'] = true;
                $result['message'] = $newSupplier['companyName'] . " successfully added";
            }
            else
            {                
                $result['status'] = false;
                $result['message'] = $newSupplier['companyName'] . " not added, contact a system admin";
            }
            return $result;
        } catch (Exception $ex) {
            //todo log error
        }
    }
            
}
