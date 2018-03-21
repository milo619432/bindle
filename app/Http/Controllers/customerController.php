<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\customerModel;

class customerController extends Controller
{
    
    public function getCustomers()
    {
        try
        {
            $customers = new customerModel();
            $allCustomers = $customers->getAllCustomers();
            
            if(sizeof($allCustomers) > 0)
            {
                return view('layouts.customermenu', ['customers' => $allCustomers]);
            }
            else
            {
                return view('layouts.customermenu');
            }
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function addSingleCustomer(request $request)
    {
        try
        {
            $newCustomerArray = 
                [
                    'accCode' => $request->code,
                    'companyName' => $request->companyName,
                    'street1' => $request->street1,
                    'street2' => $request->street2,
                    'town' => $request->town,
                    'county' => $request->county,
                    'postcode' => $request->postcode,
                    'mainPhone' => $request->mainphone,
                    'fax' => $request->fax,
                    'mainEmail' => $request->mainemail,
                    'comments' => $request->comments,
                    'installDate' => $request->install,
                    'hosted' => $request->hosted,
                    'stock' => $request->stock,
                    'pulseStore' => $request->pulseStore,
                    'terminalServer' => $request->terminalserver,
                    'pulseOfficeVersion' => $request->pulseVersion,
                    'opxmlPc' => $request->opxmlpc,
                    'sagePc' => $request->sagepc,
                    'pulseLinkPc' => $request->pulselinkpc, 
                    'sageVersion' => $request->sagenum,
                    'pulsestoreNumber' => $request->pulsestorenumber,
                    'pulsestorePassword' => $request->pulsestorepassword,
                    'upgradeNotes' => $request->upgradeNotes,
                    'networkDetails' => $request->network,
                    'licenceEnd' => $request->expiry,
                    'onHold' => $request->onhold,
                    'paidTo' => $request->paidto,
                    'licenceNotes' => $request->licenceNotes,
                    'licenceToDate' => $request->licenceToDate,
                    'vowAcc' => $request->vowacc,
                    'vowPass' => $request->vowpass,
                    'vowDisc' => $request->vowdisc,
                    'spicAcc' => $request->spicacc,
                    'spicPass' => $request->spicpass,
                    'antAcc' => $request->antacc,
                    'antPass' => $request->antpass,
                    'truacc' => $request->truacc,
                    'truPass' => $request->trupass,
                    'betaAcc' => $request->betaacc,
                    'betaPass' => $request->betapass,
                    'exertisAcc' => $request->exertacc,
                    'exertisPass' => $request->exertpass,
                    'buyingGroup' => $request->buyinggroup
                ];
                $contactArray = [
                    '0' => 
                    [
                        'conFirstName0' => $request->conFirstName0,
                        'conLastName0' => $request->conLastName0,
                        'conEmail0' => $request->conEmail0,
                        'conPhone0' => $request->conPhoneNumber0,
                        'conMain0' => $request->conMain0,
                        'conRole0' => $request->conRoleChoice0,
                    ],
                    '1' => 
                    [
                        'conFirstName1' => $request->conFirstName1,
                        'conLastName1' => $request->conLastName1,
                        'conEmail1' => $request->conEmail1,
                        'conPhone1' => $request->conPhoneNumber1,
                        'conMain1' => $request->conMain1,
                        'conRole1' => $request->conRoleChoice1,
                    ],
                    '2' => 
                    [
                        'conFirstName2' => $request->conFirstName2,
                        'conLastName2' => $request->conLastName2,
                        'conEmail2' => $request->conEmail2,
                        'conPhone2' => $request->conPhoneNumber2,
                        'conMain2' => $request->conMain2,
                        'conRole2' => $request->conRoleChoice2,
                    ],
                    '3' => 
                    [
                        'conFirstName3' => $request->conFirstName3,
                        'conLastName3' => $request->conLastName3,
                        'conEmail3' => $request->conEmail3,
                        'conPhone3' => $request->conPhoneNumber3,
                        'conMain3' => $request->conMain3,
                        'conRole3' => $request->conRoleChoice3,
                    ],
                    '4' => 
                    [
                        'conFirstName4' => $request->conFirstName4,
                        'conLastName4' => $request->conLastName4,
                        'conEmail4' => $request->conEmail4,
                        'conPhone4' => $request->conPhoneNumber4,
                        'conMain4' => $request->conMain4,
                        'conRole4' => $request->conRoleChoice4,
                    ],
                    '5' => 
                    [
                        'conFirstName5' => $request->conFirstName5,
                        'conLastName5' => $request->conLastName5,
                        'conEmail5' => $request->conEmail5,
                        'conPhone5' => $request->conPhoneNumber5,
                        'conMain5' => $request->conMain5,
                        'conRole5' => $request->conRoleChoice5,
                    ]
                ];
                
                $customer = new customerModel();
                $result = $customer->addSingleCustomer($newCustomerArray, $contactArray);
                //dd($result);
                if(in_array(false, $result))
                {
                    $resultMessage = "<div class='alert alert-danger' style='text-align:center'>Customer Creation failed. Please contact a system administrator</div>";
                }
                else
                {
                    $resultMessage = "<div class='alert alert-success' style='text-align:center'>Customer " . $newCustomerArray['companyName'] . " successfully created.</div>";
                }
                $allCustomers = $customer->getAllCustomers();
                
                return view('layouts.customermenu', ['result' => $resultMessage], ['customers' => $allCustomers]);

        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function importCustomers()
    {
        try
        {            
            $count = 0;
            $results = [
                'message' => null,
                'recordsAdded' => null
            ];
            $newCustomers = [];
            $systemData = [];
            
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] > 0)
            {
                //http://www.oodlestechnologies.com/blogs/Converting-CSV-file-into-an-Array-in-PHP
                
            }            
            else 
            {
                $results['message'] = "<div class='alert alert-danger'>File upload failed. Please select a valid file and ensure it is not empty</div>";
            }
            
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
