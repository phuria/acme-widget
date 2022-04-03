<?php

declare(strict_types=1);

namespace AcmeWidget;

use RuntimeException;

class Basket
{
    /**
     * @param string[] $productCodes
     * @return self
     */
    public static function create(array $productCodes): self
    {
        $catalog = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];

        $offers = [
            new AnotherProductCheaper($catalog['R01'], 2, 0.5),
        ];

        $deliveryRules = [
            new PriceDeliveryRule(90.0, 0.0),
            new PriceDeliveryRule(50.0, 2.95),
            new DefaultDeliveryRule(4.95),
        ];

        $basket = new self($catalog, $offers, $deliveryRules, []);

        foreach ($productCodes as $code) {
            $basket = $basket->add($code);
        }

        return $basket;
    }

    /**
     * @var Product[]
     */
    private $catalog;

    /**
     * @var Offer[]
     */
    private $offers;

    /**
     * @var DeliveryRule[]
     */
    private $deliveryRules;

    /**
     * @var string[]
     */
    private $basket;

    /**
     * @param Product[] $catalog
     * @param Offer[] $offers
     * @param DeliveryRule[] $deliveryRules
     * @param string[] $basket
     */
    private function __construct(array $catalog, array $offers, array $deliveryRules, array $basket)
    {
        $this->catalog = $catalog;
        $this->offers = $offers;
        $this->deliveryRules = $deliveryRules;
        $this->basket = $basket;
    }

    public function add(string $code): self
    {
        if (false === array_key_exists($code, $this->catalog)) {
            throw new RuntimeException("Product with code [${code}] does not exists.");
        }

        return new self($this->catalog, $this->offers, $this->deliveryRules, array_merge($this->basket, [$code]));
    }

    public function productQuantity(string $code): int
    {
        return array_count_values($this->basket)[$code] ?? 0;
    }

    public function deliveryCost(): float
    {
        foreach ($this->deliveryRules as $rule) {
            if ($rule->supports($this)) {
                return $rule->cost();
            }
        }

        throw new RuntimeException('Unable to select valid delivery rule.');
    }

    public function discount(): float
    {
        $discount = 0;

        foreach ($this->offers as $offer) {
            $discount += $offer->discount($this);
        }

        return $discount;
    }

    public function productsTotal(): float
    {
        $total = 0;

        foreach ($this->basket as $code) {
            $total += $this->catalog[$code]->price();
        }

        return $total + $this->discount();
    }

    public function total(): float
    {
        return $this->productsTotal() + $this->deliveryCost();
    }
}
