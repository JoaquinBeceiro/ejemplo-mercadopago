<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>

    
</head>
<body>

    <form action="/pagar" method="post" id="pay" name="pay" >
        <fieldset>
            <ul>
                <li>
                    <label for="email">Email</label>
                    <input id="email" name="email" value="test_user_19653727@testuser.com" type="email" placeholder="your email"/>
                </li>
                <li>
                    <label for="cardNumber">Credit card number:</label>
                    <input type="text" id="cardNumber" data-checkout="cardNumber" placeholder="4509953566233704" />
                    <img id="metodoPagoImg" src="" alt="">
                </li>
                <li>
                    <label for="securityCode">Security code:</label>
                    <input type="text" id="securityCode" data-checkout="securityCode" value="123" placeholder="123" />
                </li>
                <li>
                    <label for="cardExpirationMonth">Expiration month:</label>
                    <input type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" value="12" placeholder="12" />
                </li>
                <li>
                    <label for="cardExpirationYear">Expiration year:</label>
                    <input type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" value="2018" placeholder="2018" />
                </li>
                <li>
                    <label for="cardholderName">Card holder name:</label>
                    <input type="text" id="cardholderName" data-checkout="cardholderName" value="APRO" placeholder="APRO" />
                </li>
                <li>
                    <label for="docType">Document type:</label>
                    <select id="docType" data-checkout="docType"></select>
                </li>
                <li>
                    <label for="docNumber">Document number:</label>
                    <input type="text" id="docNumber" data-checkout="docNumber" value="12345678" placeholder="12345678" />
                </li>
            </ul>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="submit" value="Pay!" />
        </fieldset>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>


    <script>
        $(document).ready(function(){

            var mp_public = '{{ env('MP_PUBLIC_KEY') }}';

            Mercadopago.setPublishableKey( mp_public );


            Mercadopago.getIdentificationTypes();


            function addEvent(el, eventName, handler){
                if (el.addEventListener) {
                       el.addEventListener(eventName, handler);
                } else {
                    el.attachEvent('on' + eventName, function(){
                      handler.call(el);
                    });
                }
            };
            
            function getBin() {
                var ccNumber = document.querySelector('input[data-checkout="cardNumber"]');
                return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
            };
            
            function guessingPaymentMethod(event) {
                console.log("test");
                var bin = getBin();
            
                if (event.type == "keyup") {
                    if (bin.length >= 6) {
                        Mercadopago.getPaymentMethod({
                            "bin": bin
                        }, setPaymentMethodInfo);
                    }
                } else {
                    setTimeout(function() {
                        if (bin.length >= 6) {
                            Mercadopago.getPaymentMethod({
                                "bin": bin
                            }, setPaymentMethodInfo);
                        }
                    }, 100);
                }
            };
            
            function setPaymentMethodInfo(status, response) {
                if (status == 200) {
                    // do somethings ex: show logo of the payment method
                    var form = document.querySelector('#pay');
            
                    if (document.querySelector("input[name=paymentMethodId]") == null) {
                        var paymentMethod = document.createElement('input');
                        paymentMethod.setAttribute('name', "paymentMethodId");
                        paymentMethod.setAttribute('value', response[0].id);
                        paymentMethod.setAttribute('type',"hidden");

                        $("#metodoPagoImg").attr("src", response[0].thumbnail);

                        console.log( response[0] );
            
                        form.appendChild(paymentMethod);
                    } else {
                        document.querySelector("input[name=paymentMethodId]").value = response[0].id;
                    }
                }
            };

            doSubmit = false;
            function doPay(event){
                event.preventDefault();
                if(!doSubmit){
                    var $form = document.querySelector('#pay');
                    
                    Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

                    return false;
                }
            };

            function sdkResponseHandler(status, response) {
                console.log( response );
            
                if (status != 200 && status != 201) {
                    alert("verify filled data");
                }else{
                   
                    var form = document.querySelector('#pay');
            
                    var card = document.createElement('input');
                    card.setAttribute('name',"token");
                    card.setAttribute('type',"hidden");
                    card.setAttribute('value',response.id);
                    form.appendChild(card);
                    doSubmit=true;
                    form.submit();
                }
            };
            
            addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', guessingPaymentMethod);
            addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'change', guessingPaymentMethod);
            addEvent(document.querySelector('#pay'),'submit',doPay);
            

        });
        
    </script>
</body>
</html>