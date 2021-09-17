<?php

declare(strict_types=1);

namespace App\Domain\entities;

/**
 * Representa al conjunto mínimo de atributos de cualquier anuncio
 */
class BaseAd
{
    /**
     * @param int $id
     * @param array $pictures
     * @param String|null $description
     * @param int|null $property_size
     */
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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getPictures(): array
    {
        return $this->pictures;
    }

    /**
     * @param array $pictures
     */
    public function setPictures(array $pictures): void
    {
        $this->pictures = $pictures;
    }

    /**
     * @return String|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param String|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getPropertySize(): ?int
    {
        return $this->property_size;
    }

    /**
     * @param int|null $property_size
     */
    public function setPropertySize(?int $property_size): void
    {
        $this->property_size = $property_size;
    }
}