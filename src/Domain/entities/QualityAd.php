<?php

declare(strict_types=1);


namespace App\Domain\entities;

use DateTimeImmutable;

final class QualityAd extends BaseAd
{
    public function __construct(
        $id,
        $typology,
        $description,
        $pictureUrls,
        $houseSize,
        $gardenSize = null,
        public ?int $score = null,
        private ?DateTimeImmutable $irrelevantSince = null,
    ) {
        parent::__construct($id, $typology, $description, $pictureUrls, $houseSize, $gardenSize);
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getIrrelevantSince(): ?DateTimeImmutable
    {
        return $this->irrelevantSince;
    }

    public function is_relevant() : bool {
        return $this->score != null && $this->score >= 40;
    }
}
