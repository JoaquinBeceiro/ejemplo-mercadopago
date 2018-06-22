
# Ejemplo de Mercadopago con laravel

**Este es un ejemplo para realizar pagos a través de Mercadopago con PHP-Laravel**

## Table of Contents

- [Getting Started](#getting-started)
- [Usage](#usage)
- [Authors](#authors)

## Getting Started

* La documentación oficial está en:  [Mercadopago Developers](https://www.mercadopago.com.uy/developers/es/solutions/payments/custom-checkout/charge-with-creditcard/javascript/)
 
## Usage

- Se deben instalar las SDKs de MercagoPago (incluidas en composer.json): [SDK Mercadopago PHP](https://github.com/mercadopago/sdk-php)

- Tarjetas de prueba para test

    | País | Visa | Mastercard | American Express |
    | ------------- | ------------------- | ------------------- | ----------------- |
    | **Argentina** | 4509 9535 6623 3704 | 5031 7557 3453 0604 | 3711 803032 57522 |
    | **Brasil** | 4235 6477 2802 5682 | 5031 4332 1540 6351 | 3753 651535 56885 |
    | **Chile** | 4168 8188 4444 7115 | 5416 7526 0258 2580 | 3757 781744 61804 |
    | **Colombia** | 4013 5406 8274 6260 | 5254 1336 7440 3564 | 3743 781877 55283 |
    | **México** | 4075 5957 1648 3764 | 5474 9254 3267 0366 | no disponible |
    | **Perú** | 4009 1753 3280 6176 | no disponible | no disponible |
    | **Uruguay** | 4014 6823 8753 2428 | 5808 8877 7464 1586 | no disponible |
    | **Venezuela** | 4966 3823 3110 9310 | 5177 0761 6430 0010 | no disponible |

- Email para test: 'test_user_80507629@testuser.com'

- En el campo 'cardholderName'puedes probar los diferentes valores para simular resultdos 
    * APRO - Pago aprobado
    * CONT - Pago pendiente
    * CALL - Rechazo llamar para autorizar
    * FUND - Rechazo por monto insuficiente
    * SECU - Rechazo por código de seguridad
    * EXPI - Rechazo por fecha de expiración
    * FORM - Rechazo por error en formulario
    * OTHE - Rechazo general

- Crear registro para MP_PUBLIC_KEY en enviroment con tu clave pública de MercadoPago (usar modo sandbox para pruebas)
- Crear registro para MP_ACCESS_TOKEN en enviroment con tu access token de MercadoPago (usar modo sandbox para pruebas)
Las credenciales las puedes encontrar en: [Credenciales](https://www.mercadopago.com/mlu/account/credentials)

## Authors

 **Joaquin Beceiro** 
- [GitHub](https://github.com/JoaquinBeceiro) 
- [Web](https://JoaquinBeceiro.com.uy)