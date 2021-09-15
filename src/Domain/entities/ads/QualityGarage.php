<?php

declare(strict_types=1);

namespace App\Domain\entities;

final class QualityGarage extends QualityAd
{
    public function __construct(
        $id,
        $pictures,
        $description,
        $property_size,
        $score,
        $irrelevantSince
    ) {
        parent::__construct($id, $pictures, $description, $property_size, $score, $irrelevantSince);
    }
}
