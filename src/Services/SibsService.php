<?php

namespace MichelMelo\Sibs\Services;

use Exception;
use MichelMelo\Sibs\Contracts\PaymentInterface;
use MichelMelo\Sibs\Types\Card;
use MichelMelo\Sibs\Types\Checkout;
use MichelMelo\Sibs\Types\PaymentWithCard;
use MichelMelo\Sibs\Types\PaymentWithMBWay;
use MichelMelo\Sibs\Types\Transaction;

/**
 * Class SibsService.
 */
class SibsService
{
    /**
     * @param array $request
     *
     * @return PaymentInterface
     * @throws Exception
     */
    public function checkout(array $request): PaymentInterface
    {
        switch (strtoupper($request['paymentBrand'])) {
            case 'MASTER':
            case 'AMEX':
            case 'VPAY':
            case 'MAESTRO':
            case 'VISADEBIT':
            case 'VISAELECTRON':
            case 'VISA':
                /* $payment = new PaymentWithCard(
                     $request['amount'],
                     strtoupper($request['currency']),
                     strtoupper($request['paymentBrand']),
                     strtoupper($request['paymentType']),
                     $request['optionalParameters'],
                     new Card(
                         $request['number'],
                         $request['holder'],
                         $request['expiry_month'],
                         $request['expiry_year'],
                         $request['cvv']
                     )
                 );*/
                throw new \RuntimeException('SIBS_CARD Service Payment not found.', 404);

                break;
            case 'CHECKOUT':
                //$payment = new Checkout($request['amount'], $request['currency'], $request['paymentType'], $request['optionalParameters']);
                throw new \RuntimeException('CHECKOUT Service Payment not found.', 404);

                break;
            case 'SIBS_MULTIBANCO':
                throw new \RuntimeException('SIBS_MULTIBANCO Service Payment not found.', 404);

                break;
            case 'MBWAY':
                $payment = new PaymentWithMBWay(
                    $request['amount'],
                    strtoupper($request['currency']),
                    strtoupper($request['paymentBrand']),
                    strtoupper($request['paymentType']),
                    $request['accountId'],
                    $request['optionalParameters']
                );

                break;
            default:
                throw new \RuntimeException('Sibs Service Payment not found.', 404);
        }

        return $payment;
    }

    /**
     * Get payment status.
     *
     * @param string $checkoutId
     *
     * @return object
     */
    public function status(string $checkoutId): object
    {
        return (new Transaction($checkoutId))->status();
    }
}
