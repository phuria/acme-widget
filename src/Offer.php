<?php

declare(strict_types=1);

namespace AcmeWidget;

interface Offer
{
    public function discount(Basket $basket): float;
}
