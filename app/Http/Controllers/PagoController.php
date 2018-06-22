<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MP;

class PagoController extends Controller
{
    

    public function pagar( Request $request ){

        $mp = new MP( env('MP_ACCESS_TOKEN') );

        $payment_data = array(
            "transaction_amount" => 100,
            "token" => $request->token,
            "description" => "Descripcion del pago",
            "installments" => 1,
            "payment_method_id" => $request->paymentMethodId,
            "payer" => array (
                "email" => $request->email,
            )
        );

        $payment = $mp->post("/v1/payments", $payment_data);

        dd($payment);

    }

}
