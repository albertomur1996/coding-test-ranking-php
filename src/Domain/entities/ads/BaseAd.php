<?php

declare(strict_types=1);

namespace App\Domain\entities;

class BaseAd
{
    public function __construct(
        private int $id,
        private array $pictures,
        private ?String $description = null,
        private ?int $property_size = null
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
     * @return array
     */
    public function getPictures(): array
    {
        return $this->pictures;
    }

    /**
     * @return String|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getPropertySize(): ?int
    {
        return $this->property_size;
    }


}