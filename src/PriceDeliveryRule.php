<?php

declare(strict_types=1);

namespace AcmeWidget;

class PriceDeliveryRule implements DeliveryRule
{
    /**
     * @var float
     */
    private $minimalPrice;

    /**
     * @var float
     */
    private $cost;

    public function __construct(float $minimalPrice, float $cost)
    {
        $this->minimalPrice = $minimalPrice;
        $this->cost = $cost;
    }

    public function supports(Basket $basket): bool
    {
        return $this->minimalPrice <= $basket->productsTotal();
    }

    public function cost(): float
    {
        return $this->cost;
    }
}
