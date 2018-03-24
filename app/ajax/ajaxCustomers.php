<?php

namespace App\ajax;
use Illuminate\Support\Facades\DB;

try
        {
            $customers = DB::select("SELECT customers.custID, 
                                    customers.CustCode,
                                    customers.CustName, 
                                    customers.MainPhone, 
                                    customers.MainEmail,                                    
                                    systemdata.hosted,
                                    systemdata.PulseStore,
                                    customers.StockControl, 
                                    customers.OnHold,
                                    customers.DatePaidTo 
                                    FROM customers                                     
                                    INNER JOIN systemdata 
                                    ON customers.CustID=systemdata.CustID 
                                    ORDER BY CustCode Asc;");            
            $customersJSON = json_encode($customers);
            echo $customersJSON;
        } catch (Exception $ex) {
            //todo logerrors
        }