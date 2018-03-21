<?php

namespace App\models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class customerModel extends Model
{
    
    public function ImportCSV2Array($filename)
    {
        $row = 0;
        $col = 0;

        $handle = @fopen($filename, "r");
        if ($handle) 
        {
            while (($row = fgetcsv($handle, 4096)) !== false) 
            {
                if (empty($fields)) 
                {
                    $fields = $row;
                    continue;
                }

                foreach ($row as $k=>$value) 
                {
                    $results[$col][$fields[$k]] = $value;
                }
                $col++;
                unset($row);
            }
            if (!feof($handle)) 
            {
                echo "Error: unexpected fgets() failn";
            }
            fclose($handle);
        }

        return $results;
    }
    
    public function importCustomers($customerArray)
    {
        try
        {
            if($customerArray && sizeof($customerArray) > 0)
            {
//                dd($customerArray['127']);
                foreach ($customerArray as $key => $value)
                {
                    //var_dump($key . " : " . $value['CustName']);
                }
            }
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function getAllCustomers()
    {
        try
        {
            $customers = DB::select("SELECT customers.custID, 
                                    customers.CustCode,
                                    customers.CustName, 
                                    customers.MainPhone, 
                                    customers.MainEmail,
                                    contacts.FirstName,
                                    contacts.SurName,
                                    systemdata.hosted,
                                    systemdata.PulseStore,
                                    customers.StockControl, 
                                    customers.OnHold 
                                    FROM customers 
                                    INNER JOIN contacts 
                                    ON customers.CustID=contacts.CustID 
                                    INNER JOIN systemdata 
                                    ON customers.CustID=systemdata.CustID 
                                    WHERE contacts.MainPulseContact = 1;");          
            
            return $customers;
        } catch (Exception $ex) {
            //todo logerrors
        }
    }
    
    public function addSingleCustomer($details, $contacts)
    {
        try
        {
            //dd($contacts);
            //results array to return to controller
            $resultsMessages = 
            [
                'custResult' => false,
                'systemResult' => false
            ];
            
            //if form details are here, deal with checkbox values and insert base customer data
            if($details)
            {                
                if($details['hosted'] == null)
                {
                    $details['hosted'] = 0;
                }
                else
                {
                    $details['hosted'] = 1;
                }
                if($details['onHold'] == null)
                {
                    $details['onHold'] = 0;
                } else 
                {
                    $details['onHold'] = 1;
                }
                if($details['stock'] == null)
                {
                    $details['stock'] = 0;
                }
                else 
                {
                    $details['stock'] = 1;
                }
                $results = DB::insert('INSERT INTO customers (CustCode, '
                        . 'CustName, '
                        . 'Street1, '
                        . 'Street2, '
                        . 'Town, '
                        . 'County, '
                        . 'Postcode, '
                        . 'MainPhone, '
                        . 'Fax, '
                        . 'MainEmail, '
                        . 'LicenceExpiry, '
                        . 'DatePaidTo, '
                        . 'OnHold, '
                        . 'Comments, '
                        . 'StockControl, '
                        . 'LicenceToDate, '
                        . 'LicenceNotes, '
                        . 'SpecialUpgradeNotes, '
                        . 'InstallDate) '
                        . 'values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
                        [
                            $details['accCode'],
                            $details['companyName'],
                            $details['street1'],
                            $details['street2'],
                            $details['town'],
                            $details['county'],
                            $details['postcode'],
                            $details['mainPhone'],
                            $details['fax'],
                            $details['mainEmail'],
                            $details['licenceEnd'],
                            $details['paidTo'],
                            $details['onHold'],
                            $details['comments'],
                            $details['stock'],
                            $details['licenceToDate'],
                            $details['licenceNotes'],
                            $details['upgradeNotes'],
                            $details['installDate']
                        ]);
                
                //if base customer insert is successful set result message and proceed to insert system data
                if($results && true == $results)
                    {
                        $resultsMessages['custResult'] = true;
                        if($details['terminalServer'] == null)
                        {
                            $details['terminalServer'] = 0;
                        }
                        else 
                        {
                            $details['terminalServer'] = 1;
                        }
                        if($details['pulseStore'] == null)
                        {
                            $details['pulseStore'] = 0;
                        }
                        else
                        {
                            $details['pulseStore'] = 1;
                        }
                        $custID = DB::getPdo()->lastInsertId();
                        $systemResult = DB::insert('INSERT INTO systemdata (custID, '
                                . 'PulseVersion, '
                                . 'OPXMLPC, '
                                . 'SageLinkPC, '
                                . 'PulseLinkPC, '
                                . 'TerminalServer, '
                                . 'VowAccNo, '
                                . 'VowPassword, '
                                . 'VowDiscount, '
                                . 'SpicerAccNo, '
                                . 'SpicerPassword, '
                                . 'AntalisAccNo, '
                                . 'AntalisPassword, '
                                . 'TrulineAccNo, '
                                . 'TrulinePassword, '
                                . 'BetaAccNo, '
                                . 'BetaPassword, '
                                . 'ExertisAccNo, '
                                . 'ExertisPassword, '
                                . 'SageVersion, '
                                . 'NetworkDetails, '
                                . 'PulseStore, '
                                . 'PulseStoreShopNumber, '
                                . 'BuyingGroup, '
                                . 'PulseStorePassword, '
                                . 'hosted)'
                                . ' values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
                                [
                                    $custID,
                                    $details['pulseOfficeVersion'],
                                    $details['opxmlPc'],
                                    $details['sagePc'],
                                    $details['pulseLinkPc'], 
                                    $details['terminalServer'],
                                    $details['vowAcc'],
                                    $details['vowPass'],
                                    $details['vowDisc'],
                                    $details['spicAcc'], 
                                    $details['spicPass'],
                                    $details['antAcc'],
                                    $details['antPass'],
                                    $details['truacc'],
                                    $details['truPass'],
                                    $details['betaAcc'],
                                    $details['betaPass'],
                                    $details['exertisAcc'],
                                    $details['exertisPass'],
                                    $details['sageVersion'],
                                    $details['networkDetails'],
                                    $details['pulseStore'],
                                    $details['pulsestoreNumber'],
                                    $details['buyingGroup'],
                                    $details['pulsestorePassword'],
                                    $details['hosted']
                                ]);
                        
                        //if system details insert successful insert contact data
                        if($systemResult && true == $systemResult)
                        {
                            $resultsMessages['systemResult'] = true;
                            //insert contacts 
                            $contactCount = 0;
                            foreach($contacts as $key => $value)
                            {                                
                                if($value['conMain' . $contactCount]  == null)
                                {
                                    $value['conMain' . $contactCount]  = 0;
                                } 
                                else 
                                {
                                    $value['conMain' . $contactCount] = 1;
                                }
                                
                                if(strlen($value['conFirstName' . $contactCount]) == 0 )
                                {
                                    break;
                                }
                                else 
                                {
                                    $contactsResult = DB::insert('INSERT INTO contacts ('
                                        . 'CustID, '
                                        . 'FirstName, '
                                        . 'SurName, '
                                        . 'Phone, '
                                        . 'Email, '
                                        . 'MainPulseContact, '
                                        . 'RoleID) values (?,?,?,?,?,?,?)', 
                                        [
                                            $custID,
                                            $value['conFirstName' . $contactCount] ,
                                            $value['conLastName'. $contactCount],
                                            $value['conPhone' . $contactCount],
                                            $value['conEmail' . $contactCount],
                                            $value['conMain' . $contactCount ],
                                            $value['conRole' . $contactCount]
                                        ]);
                                $contactCount ++;
                                }
                                
                            }
                        if($contactsResult && True == $contactsResult)
                        {
                            $resultsMessages['contactsResult'] = true;
                        }
                        }
                        return $resultsMessages;
                    }
                    else 
                    {
                        $resultsMessages['custResult'] = false;
                        return $resultsMessages;                        
                    }                
            }
        }
        catch (Exception $ex) {
            //todo log errors
        }
    }
}
