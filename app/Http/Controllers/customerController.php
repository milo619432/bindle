<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\customerModel;

class customerController extends Controller
{
        
    public function getCustomers(Request $request)
    {
        try
        {
            $customers = new customerModel();
            $allCustomers = $customers->getAllCustomers();
            
            if(sizeof($allCustomers) > 0)
            {
                $customerJSON = json_encode($allCustomers);
                echo $customerJSON;                
            }
            else
            {
                //return view('layouts.customermenu');
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
                
                $customer = new customerModel();
                $result = $customer->addSingleCustomer($newCustomerArray);  
                
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
            $results = [
                'message' => null,
                'recordsAdded' => null
            ];
            $newCustomers = [];
            $systemData = [];
            $fileName = $_FILES['file']['tmp_name'];
            
            if(is_uploaded_file($fileName) && $_FILES['file']['size'] > 0)
            {
                $customer = new customerModel();
                $csvArray = $customer->ImportCSV2Array($fileName);
                $importResult = $customer->importCustomers($csvArray);
                $allCustomers = $customer->getAllCustomers();
                if($importResult && true == $importResult)
                {
                    $results['message'] = "<div class='alert alert-success'>File upload Completed. Please Upload customer contacts now.</div>";
                    return view('layouts.custoermenu', ['result' => $results['message']], ['customers' => $allCustomers]);
                }
                else
                {
                    $results['message'] = "<div class='alert alert-danger'>File upload Failed. Please contact an admin.</div>";
                    return view('layouts.custoermenu', ['result' => $results['message']], ['customers' => $allCustomers]);
                }
                                
            }            
            else 
            {
                $results['message'] = "<div class='alert alert-danger'>File upload failed. Please select a valid file and ensure it is not empty</div>";
            }
            
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function getSingleCustomer(){
        try
        {
            $id = $_GET['queryString'];            
            $customer = new customerModel();
            $customerResult = $customer->getSingleCustomer($id);
            $result = json_encode($customerResult);
            echo $result;
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function editCustomer(request $request)
    {
        try
        {
            $editCustomerArray = 
                [
                    'id' => $request->id, 
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

                $ammendedCustomer = new customerModel();
                $ammendCustomerResult = $ammendedCustomer->editCustomer($editCustomerArray);
                
                if($ammendCustomerResult['status'] == true)
                {
                    $resultMessage = "<div class='alert alert-success' style='text-align:center'>Customer " . $editCustomerArray['companyName'] . " successfully edited.</div>";
                }
                else
                {
                    $resultMessage = "<div class='alert alert-success' style='text-align:center'>Customer " . $editCustomerArray['companyName'] . " editing failed.</div>";
                }
                
                $allCustomers = $ammendedCustomer->getAllCustomers();
                
                return view('layouts.customermenu', ['result' => $resultMessage], ['customers' => $allCustomers]);
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
