<?php

namespace MichelMelo\Sibs\Types;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class PaymentWithMBWay.
 */
class PaymentWithMBWay extends Payment
{
    /**
     * @var string
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $clientConfig = [];

    /**
     * PaymentWithMBWay constructor.
     *
     * @param float  $amount
     * @param string $currency
     * @param string $paymentBrand
     * @param string $paymentType
     * @param string $accountId
     * @param array  $optionalParameters
     */
    public function __construct(
        float $amount,
        string $currency,
        string $paymentBrand,
        string $paymentType,
        string $accountId,
        array $optionalParameters
    ) {
        parent::__construct($amount, $currency, $paymentBrand, $paymentType, $optionalParameters);
        $this->accountId = $accountId;
        $this->endpoint  = config('sibs.host') . config('sibs.version') . '/';
    }

    /**
     * Execute the payment.
     *
     * @return object
     */
    public function pay()
    {
        $data = (object) null;

        try {
            $client = new Client($this->clientConfig);

            $payload = [
                'entityId'                 => config('sibs.authentication.entityId'),
                'amount'                   => number_format($this->amount, 2, '.', ''),
                'currency'                 => $this->currency,
                'paymentBrand'             => $this->paymentBrand,
                'paymentType'              => $this->paymentType,
                'virtualAccount.accountId' => $this->accountId,
            ];

            if (config('sibs.mode') === 'test') {
                $payload = array_merge(
                    $payload,
                    [
                        'customParameters[SIBS_ENV]' => 'QLY',
                        'testMode'                   => 'EXTERNAL',
                    ]
                );
            }
            $response = $client->post($this->endpoint . 'payments', [
                'headers' => [
                    'Authorization' => config('sibs.authentication.token'),
                ],
                'form_params' => array_merge($payload, $this->getOptionalParameters()),
            ]);

            $data->status   = $response->getStatusCode();
            $data->response = json_decode($response->getBody()->getContents(), false);

            return $data;
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $data->status   = $response->getStatusCode();
            $data->response = json_decode($response->getBody()->getContents(), false);

            return $data;
        }
    }
}
