<?php

declare(strict_types=1);

namespace App\Domain\entities;

final class QualityFlat extends QualityAd
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

    public function __toString(){
        return json_encode($this);
    }
}
