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
                        'conFirstName1' => $request->conFirstName,
                        'conLastName1' => $request->conLastName,
                        'conEmail1' => $request->conEmail,
                        'conPhone1' => $request->conPhoneNumber,
                        'conMain1' => $request->conMain,
                        'conRole1' => $request->conRoleChoice,
                    ],
                    '2' => 
                    [
                        'conFirstName2' => $request->conFirstName,
                        'conLastName2' => $request->conLastName,
                        'conEmail2' => $request->conEmail,
                        'conPhone2' => $request->conPhoneNumber,
                        'conMain2' => $request->conMain,
                        'conRole2' => $request->conRoleChoice,
                    ],
                    '3' => 
                    [
                        'conFirstName3' => $request->conFirstName,
                        'conLastName3' => $request->conLastName,
                        'conEmail3' => $request->conEmail,
                        'conPhone3' => $request->conPhoneNumber,
                        'conMain3' => $request->conMain,
                        'conRole3' => $request->conRoleChoice,
                    ],
                    '4' => 
                    [
                        'conFirstName4' => $request->conFirstName,
                        'conLastName4' => $request->conLastName,
                        'conEmail4' => $request->conEmail,
                        'conPhone4' => $request->conPhoneNumber,
                        'conMain4' => $request->conMain,
                        'conRole4' => $request->conRoleChoice,
                    ],
                    '5' => 
                    [
                        'conFirstName5' => $request->conFirstName,
                        'conLastName5' => $request->conLastName,
                        'conEmail5' => $request->conEmail,
                        'conPhone5' => $request->conPhoneNumber,
                        'conMain5' => $request->conMain,
                        'conRole5' => $request->conRoleChoice,
                    ]
                ];
                $customer = new customerModel();
                $result = $customer->addSingleCustomer($newCustomerArray, $contactArray);

        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
