<?php

declare(strict_types=1);


namespace App\Domain\entities;

use DateTimeImmutable;

class QualityAd extends BaseAd
{
    public function __construct(
        $id,
        $pictures,
        $description,
        $property_size,
        public ?int $score = null,
        private ?DateTimeImmutable $irrelevantSince = null,
    ) {
        parent::__construct($id, $pictures, $description, $property_size);
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @param int|null $score
     */
    public function setScore(?int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getIrrelevantSince(): ?DateTimeImmutable
    {
        return $this->irrelevantSince;
    }

    /**
     * @param DateTimeImmutable|null $irrelevantSince
     */
    public function setIrrelevantSince(?DateTimeImmutable $irrelevantSince): void
    {
        $this->irrelevantSince = $irrelevantSince;
    }



    public function is_relevant() : bool {
        return $this->score != null && $this->score >= 40;
    }
}
