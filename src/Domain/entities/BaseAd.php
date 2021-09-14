<?php

declare(strict_types=1);

namespace App\Domain\entities;

class BaseAd
{
    public function __construct(
        private int $id,
        private String $typology,
        private String $description,
        private array $pictures,
        private int $houseSize,
        private ?int $gardenSize = null
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getTypology(): string
    {
        return $this->typology;
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getPictures(): array
    {
        return $this->pictures;
    }

    /**
     * @return int
     */
    public function getHouseSize(): int
    {
        return $this->houseSize;
    }

    /**
     * @return int|null
     */
    public function getGardenSize(): ?int
    {
        return $this->gardenSize;
    }


}