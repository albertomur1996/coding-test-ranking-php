<?php

declare(strict_types=1);

namespace App\Domain\entities;

final class QualityChalet extends QualityAd
{
    public function __construct(
        $id,
        $pictures,
        $description,
        $property_size,
        $score,
        $irrelevantSince,
        private ?int $gardenSize = null
    ) {
        parent::__construct($id, $pictures, $description, $property_size, $score, $irrelevantSince);
    }

    /**
     * @return int|null
     */
    public function getGardenSize(): ?int
    {
        return $this->gardenSize;
    }

    public function __toString(){
        $output = '';



        return $output;
    }
}
