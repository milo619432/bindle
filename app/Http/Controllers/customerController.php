<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\customerModel;

class customerController extends Controller
{
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
                    'pulsestorePassword' => $request->pulsestorePassword,
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
                    'truacc' => $request->trupacc,
                    'truPass' => $request->trupass,
                    'betaAcc' => $request->betaacc,
                    'betaPass' => $request->betapass,
                    'exertisAcc' => $request->exertacc,
                    'exertisPass' => $request->exertpass,
                    'buyingGroup' => $request->buyinggroup
                ];
                $contactArray = [
                    'contact0' => 
                    [
                        'conFirstName' => $request->conFirstName,
                        'conLastName' => $request->conLastName,
                        'conEmail' => $request->conEmail,
                        'conPhone' => $request->conPhoneNumber,
                        'conMain' => $request->conMain,
                        'conRole' => $request->conRoleChoice,
                    ],
                    'contact1' => 
                    [
                        'conFirstName1' => $request->conFirstName1,
                        'conLastName1' => $request->conLastName1,
                        'conEmail1' => $request->conEmail1,
                        'conPhone1' => $request->conPhoneNumber1,
                        'conMain1' => $request->conMain1,
                        'conRole1' => $request->conRoleChoice1,
                    ],
                    'contact2' => 
                    [
                        'conFirstName2' => $request->conFirstName1,
                        'conLastName2' => $request->conLastName1,
                        'conEmail2' => $request->conEmail1,
                        'conPhone2' => $request->conPhoneNumber1,
                        'conMain2' => $request->conMain1,
                        'conRole2' => $request->conRoleChoice1,
                    ],
                    'contact3' => 
                    [
                        'conFirstName3' => $request->conFirstName1,
                        'conLastName3' => $request->conLastName1,
                        'conEmail3' => $request->conEmail1,
                        'conPhone3' => $request->conPhoneNumber1,
                        'conMain3' => $request->conMain1,
                        'conRole3' => $request->conRoleChoice1,
                    ],
                    'contact4' => 
                    [
                        'conFirstName4' => $request->conFirstName1,
                        'conLastName4' => $request->conLastName1,
                        'conEmail4' => $request->conEmail1,
                        'conPhone4' => $request->conPhoneNumber1,
                        'conMain4' => $request->conMain1,
                        'conRole4' => $request->conRoleChoice1,
                    ],
                    'contact5' => 
                    [
                        'conFirstName5' => $request->conFirstName1,
                        'conLastName5' => $request->conLastName1,
                        'conEmail5' => $request->conEmail1,
                        'conPhone5' => $request->conPhoneNumber1,
                        'conMain5' => $request->conMain1,
                        'conRole5' => $request->conRoleChoice1,
                    ]
                ];
                $customer = new customerModel();
                $result = $customer->addSingleCustomer($newCustomerArray, $contactArray);

        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
