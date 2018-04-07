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
                
                foreach ($customerArray as $key => $value)
                {   
                    //dd($value);
                    $newCustIDS = [];
                    //hacky manipulation for crap input data -- mostly Andys data
                    if(TRUE == $value['PulseStore'])
                    {
                        $value['PulseStore'] = 1;
                    }
                    else 
                    {
                        $value['PulseStore'] = 0;
                    }
                    
                    if(!empty($value['Date Licence Expires']))
                    {
                        $value['Date Licence Expires'] =implode("-", array_reverse(explode("/", $value['Date Licence Expires'])));
                    }
                    else 
                    {
                        $value['Date Licence Expires'] = null;
                    }
                    
                    if(!empty($value['Date paid up until PO']))
                    {
                        $value['Date paid up until PO'] =implode("-", array_reverse(explode("/", $value['Date paid up until PO'])));                    
                    }
                    else 
                    {
                        $value['Date paid up until PO'] = null;
                    }
                    
                    if(FALSE == $value['Stock Control?'])
                    {
                        $value['Stock Control?'] = 0;
                    } 
                    else
                    {
                        $value['Stock Control?'] = 1;
                    }
                    
                    if(!empty($value['Generate licece to']))
                    {
                        $value['Generate licece to'] =implode("-", array_reverse(explode("/", $value['Generate licece to'])));
                    }
                    else
                    {
                        $value['Generate licece to'] = null;
                    }
                    
                    if(!empty($value['Install Date']))
                    {
                        $value['Install Date'] =implode("-", array_reverse(explode("/", $value['Install Date'])));
                    }
                    else
                    {
                        $value['Install Date'] = null;
                    }                    
                    
                    //-----------------------------------------------------------------------------------------------------------
                    //do customer table insert first
                    $insertResult = DB::insert(
                            "INSERT INTO customers ("
                            . "CustCode, "
                            . "CustName, "
                            . "Street1, "
                            . "Street2, "
                            . "Town, "
                            . "County, "
                            . "Postcode, "
                            . "MainPhone, "
                            . "Fax, "
                            . "MainEmail, "
                            . "LicenceExpiry, "
                            . "DatePaidTo, "
                            . "OnHold, "
                            . "Comments, "
                            . "StockControl, "
                            . "LicenceToDate, "
                            . "LicenceNotes, "
                            . "SpecialUpgradeNotes, "                            
                            . "InstallDate) "
                            . "values "
                            . "(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",                            
                            [
                                $value['CustCode'], 
                                $value['CustName'],
                                $value['CustStreet1'],
                                $value['CustStreet2'], 
                                $value['CustTown'],
                                $value['CustCounty'],
                                $value['CustPostCode'],
                                $value['CustMainPhone'],
                                $value['CustFax'],
                                $value['Main email address'],
                                $value['Date Licence Expires'],
                                $value['Date paid up until PO'],
                                $value['onHold'],
                                $value['Comments'],
                                $value['Stock Control?'],
                                $value['Generate licece to'],
                                $value['Licence notes'],
                                $value['More notes'],                                
                                $value['Install Date']
                            ]);       
                //if customer insert successfull do system data insert
                if(true == $insertResult)
                {
                    $custID = DB::getPdo()->lastInsertId();
                    $systemInsertResult = DB::insert("INSERT INTO systemdata ("
                            . "custID, "
                            . "PulseVersion, "
                            . "OPXMLPC, "
                            . "SageLinkPC, "
                            . "PulseLinkPC, "
                            . "TerminalServer, "
                            . "VowAccNo, "
                            . "VowPassword, "
                            . "VowDiscount, "
                            . "SpicerAccNo, "
                            . "SpicerPassword, "
                            . "AntalisAccNo, "
                            . "AntalisPassword, "
                            . "TrulineAccNo, "
                            . "TrulinePassword, "
                            . "BetaAccNo, "
                            . "BetaPassword, "
                            . "ExertisAccNo, "
                            . "ExertisPassword, "
                            . "SageVersion, "
                            . "NetworkDetails, "
                            . "PulseStore, "
                            . "PulseStoreShopNumber, "
                            . "buyingGroup, "
                            . "PulseStorePassword, "
                            . "hosted) "
                            . "values "
                            . "(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
                            [
                                $custID,
                                $value['pulseVersion'],
                                $value['Opxml Link Machine'],
                                $value['Sage Link Machine'],
                                $value['PulseLink Machine'],
                                $value['TerminalServer'], 
                                $value['VOW Account No'],
                                $value['VOW OPXML Password'],
                                $value['VOW Discount'],
                                $value['Spicers account No'],
                                $value['Spicers OPXML Password'],
                                $value['Antalis Account No'],
                                $value['Antalis OPXML Password'],
                                $value['Truline User name'],
                                $value['Truline Password'],
                                $value['Beta Account no'],
                                $value['Beta opxml password'],
                                $value['Exertis username'],
                                $value['Exertis Password'],
                                $value['Sage Version'],
                                $value['Network or password info'],
                                $value['PulseStore'],
                                $value['pulsestore Shopnumber'],
                                $value['buyingGroup'],
                                $value['Pulsestore password'],
                                $value['hosted']
                            ]);
                    if(true == $systemInsertResult)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                } 
                else 
                {
                    return false;
                }

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
                                    systemdata.hosted,
                                    systemdata.PulseStore,
                                    customers.StockControl, 
                                    customers.OnHold,
                                    customers.DatePaidTo 
                                    FROM customers                                     
                                    INNER JOIN systemdata 
                                    ON customers.CustID=systemdata.CustID 
                                    ORDER BY CustCode Asc;");            
            return $customers;
        } catch (Exception $ex) {
            //todo logerrors
        }
    }
    
    public function getSingleCustomer($id)
    {
        try
        {
            if($id && $id > 0){
                $customer = DB::select("SELECT * FROM customers, systemdata WHERE customers.custID =" . $id . " AND systemdata.CustID =" . $id . ";");
                return($customer);
            }
            else 
            {
                return "No customer details found";
            }
            
        } catch (Exception $ex) {

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
    
    public function editCustomer($details)
    {
        try
        {            
            $result = [
                'status' => null,
                'message' => null
            ];
            //if form details are here, deal with checkbox values and insert base customer data
            if($details)
            {                
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
            }
            if(null == $details['licenceEnd'])
            {
                $details['licenceEnd'] = date('Y-m-d');
            }
            if(null == $details['licenceToDate'])
            {
                $details['licenceToDate'] = date('Y-m-d');
            }
            if(null == $details['paidTo'])
            {
                $details['paidTo'] = date('Y-m-d');
            }
            if(null == $details['installDate'])
            {
                $details['installDate'] = date('Y-m-d');
            }
            
            $updateResult = DB::update("UPDATE customers SET "
                    . "CustCode='" . $details['accCode'] . "', "
                    . "CustName='" .  $details['companyName'] ."', "
                    . "Street1='" . $details['street1'] . "', "
                    . "Street2='" . $details['street2']  . "', "
                    . "Town='" . $details['town'] . "', "
                    . "County='" . $details['county'] . "', "
                    . "Postcode='" . $details['postcode'] . "', "
                    . "MainPhone='" . $details['mainPhone'] . "', "
                    . "Fax='" . $details['fax'] . "', "
                    . "MainEmail='" . $details['mainEmail'] . "', "
                    . "LicenceExpiry='" . $details['licenceEnd'] . "', "
                    . "DatePaidTo='" . $details['paidTo'] . "', "
                    . "OnHold='" . $details['onHold'] . "', "
                    . "Comments='" . $details['comments'] . "', "
                    . "StockControl='" . $details['stock'] . "', "
                    . "LicenceToDate='" . $details['licenceToDate'] . "', "
                    . "LicenceNotes='" . $details['licenceNotes'] . "', "
                    . "SpecialUpgradeNotes='" . $details['upgradeNotes'] . "', "
                    . "InstallDate='" . $details['installDate'] . "' "
                    . "WHERE CustID = " . $details['id'] . ";"
                    );
            $systemDataResult = DB::update("UPDATE systemdata SET "
                    . " PulseVersion='" . $details['pulseOfficeVersion'] . "', "
                    . " OPXMLPC='" . $details['opxmlPc'] . "', "
                    . " SageLinkPC='" . $details['sagePc'] . "', "
                    . " PulseLinkPC='" . $details['pulseLinkPc'] . "', "
                    . " TerminalServer='" . $details['terminalServer'] . "', "
                    . " VowAccNo='" . $details['vowAcc'] . "', "
                    . " VowPassword='" . $details['vowPass'] . "', "
                    . " VowDiscount='" . $details['vowDisc'] . "', "
                    . " SpicerAccNo='" . $details['spicAcc'] . "', "
                    . " SpicerPassword='" . $details['spicPass'] . "', "
                    . " AntalisAccNo='" . $details['antAcc'] . "', "
                    . " AntalisPassword='" . $details['antPass'] . "', "
                    . " TrulineAccNo='" . $details['truacc'] . "', "
                    . " TrulinePassword='" . $details['truPass'] . "', "
                    . " BetaAccNo='" . $details['betaAcc'] . "', "
                    . " BetaPassword='" . $details['betaPass'] . "', "
                    . " ExertisAccNo='" . $details['exertisAcc'] . "', "
                    . " ExertisPassword='" . $details['exertisPass'] . "', "
                    . " SageVersion='" . $details['sageVersion'] . "', "
                    . " NetworkDetails='" . $details['networkDetails'] .  "', "
                    . " PulseStore='" . $details['pulseStore'] . "', "
                    . " PulseStoreShopNumber='" . $details['pulsestoreNumber'] . "', "
                    . " BuyingGroup='" . $details['buyingGroup'] . "', "
                    . " PulseStorePassword='" . $details['pulsestorePassword'] .  "', "
                    . " hosted='" . $details['hosted'] . "' "
                    . " WHERE custID = " . $details['id'] . "");


                $result['status'] = true;
                $result['message'] = "Updates successful";
                return $result;

        } catch (Exception $ex) {            
                $result['status'] = false;
                $result['message'] = "Updates false";
                return $result;
            //todo log errors
        }
    }
}
