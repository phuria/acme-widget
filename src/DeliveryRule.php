<?php

declare(strict_types=1);

namespace AcmeWidget;

interface DeliveryRule
{
    public function supports(Basket $basket): bool;

    public function cost(): float;
}
