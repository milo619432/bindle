<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
                    'sageVersion' => $request->sagenum,
                    'pulsestoreNumber' => $request->pulsestorenumber,
                    'pulsestorePassword' => $request->pulsestorePassword,
                    'upgradeNotes' => $request->upgradeNotes,
                    'networkDetails' => $request->network,
                    'licenceEnd' => $request->expiry,
                    'onHold' => $request->onhold,
                    'paidTo' => $request->paidto,
                    'licenceNotes' => $request->licenceNotes,
                    'vowAcc' => $request->vowacc,
                    'vowPass' => $request->vowpass,
                    'vowDisc' => $request->vowdisc,
                    'spicAcc' => $request->spicacc,
                    'spicPass' => $request->spicpass,
                    'antAcc' => $request->antacc,
                    'antPass' => $request->antpass,
                    'truacc' => $request->trupass,
                    'betaAcc' => $request->betaacc,
                    'betaPass' => $request->betapass,
                    'exertisAcc' => $request->exertacc,
                    'exertisPass' => $request->exertpass,
                    'buyingGroup' => $request->buyinggroup
                ];
            print_r($newCustomerArray);
            die();
        } catch (Exception $ex) {
            //todo log errors
        }
    }
}
