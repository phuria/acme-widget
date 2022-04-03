<?php

declare(strict_types=1);

namespace AcmeWidget;

class AnotherProductCheaper implements Offer
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var float
     */
    private $discountPercentage;

    public function __construct(Product $product, float $quantity, float $discountPercentage)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->discountPercentage = $discountPercentage;
    }

    public function discount(Basket $basket): float
    {
        $basketQuantity = $basket->productQuantity($this->product->code());
        $multiplier = floor($basketQuantity / $this->quantity);

        return -1 * $multiplier * round($this->product->price() * $this->discountPercentage, 2);
    }
}
