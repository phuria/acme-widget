<?php

declare(strict_types=1);

namespace AcmeWidget;

class DefaultDeliveryRule implements DeliveryRule
{
    /**
     * @var float
     */
    private $cost;

    public function __construct(float $cost)
    {
        $this->cost = $cost;
    }

    public function supports(Basket $basket): bool
    {
        return true;
    }

    public function cost(): float
    {
        return $this->cost;
    }
}
