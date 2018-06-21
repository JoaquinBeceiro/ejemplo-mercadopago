
# Ejemplo de Mercadopago con laravel

Este es un ejemplo para realizar pagos a través de Mercadopago con PHP-Laravel

## Getting Started

La documentación oficial esta en:
* [Link](https://www.mercadopago.com.uy/developers/es/solutions/payments/custom-checkout/charge-with-creditcard/javascript/) - Mercadopago Developers
 

### Installing

Se deben instalar las SDKs de MercagoPago
* [Link](https://github.com/mercadopago/sdk-php) - SDK Mercadopago PHP

Para confirmar el pago una vez realizados todos los pasos se debe hacer el siguiente request en la URL /pagar (PagoController@pagar)

```
<?php
require_once ('mercadopago.php');

$mp = new MP('ACCESS_TOKEN');

$payment_data = array(
	"transaction_amount" => 100,
	"token" => "ff8080814c11e237014c1ff593b57b4d",
	"description" => "Title of what you are paying for",
	"installments" => 1,
	"payment_method_id" => "visa",
	"payer" => array (
		"email" => "test_user_19653727@testuser.com"
	)
);

$payment = $mp->post("/v1/payments", $payment_data);
```


## Authors

* **Joaquin Beceiro** - [JoaquinBeceiro](https://github.com/JoaquinBeceiro)