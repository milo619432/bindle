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
                                . 'PulseStorePassword) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
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
                                    $details['pulsestorePassword']
                                ]);
                        
                        //if system details insert successful insert contact data
                        if($systemResult && true == $systemResult)
                        {
                            $resultsMessages['systemResult'] = true;
                            //insert contacts                            
                            foreach($contacts as $key => $value)
                            { 
//                                if($value['conMain'] == null && isset($value['conMain']))
//                                {
//                                    $value['conMain'] = 0;
//                                } 
//                                else 
//                                {
//                                    $value['conMain'] = 1;
//                                }
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
                                            $value['conFirstName'],
                                            $value['conLastName'],
                                            $value['conPhone'],
                                            $value['conEmail'],
                                            $value['conMain'],
                                            $value['conRole']
                                        ]);
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
