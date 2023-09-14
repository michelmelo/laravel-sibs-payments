<?php

namespace MichelMelo\Sibs\Types;

use MichelMelo\Sibs\Contracts\PaymentInterface;

/**
 * Class Payment.
 */
abstract class Payment implements PaymentInterface
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $paymentBrand;

    /**
     * @var array
     */
    protected $optionalParameters = [];

    /**
     * @var string
     */
    protected $paymentType;

    /**
     * Payment constructor.
     *
     * @param float  $amount
     * @param string $currency
     * @param string $paymentBrand
     * @param string $paymentType
     * @param array  $optionalParameters
     */
    public function __construct(float $amount, string $currency, string $paymentBrand, string $paymentType, array $optionalParameters)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
        $this->setBrand($paymentBrand);
        $this->setType($paymentType);
        $this->setOptionalParameters($optionalParameters);
    }

    /**
     * @return array
     */
    public function getOptionalParameters(): array
    {
        return $this->optionalParameters;
    }

    /**
     * @param array $optionalParameters
     */
    public function setOptionalParameters(array $optionalParameters): void
    {
        $this->optionalParameters = $optionalParameters;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->paymentBrand;
    }

    /**
     * @param string $paymentBrand
     */
    public function setBrand(string $paymentBrand): void
    {
        $this->paymentBrand = $paymentBrand;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     */
    public function setType(string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }
}
