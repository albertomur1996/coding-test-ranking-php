<?php

declare(strict_types=1);

namespace App\Domain\entities\ads;

/**
 * Añade atributos específicos para los anuncios de propiedades inmobiliarias tipo chalet (en este
 * caso el tamaño del jardín).
 *
 * La clase fue creada, en sustitución al atributo typology, debido a que no todos los tipos de propiedades
 * inmobiliarias tienen las mismas características.
 *
 * Se ha creído más conveniente esta aproximación para aportar
 * mayor legibilidad al no mezclar atributos de diferentes tipos de inmuebles en la misma clase
 */
final class QualityChalet extends QualityAd
{
    /**
     * @param $id
     * @param $pictures
     * @param $description
     * @param $property_size
     * @param $score
     * @param $irrelevantSince
     * @param int|null $gardenSize
     */
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

    /**
     * @param int|null $gardenSize
     */
    public function setGardenSize(?int $gardenSize): void
    {
        $this->gardenSize = $gardenSize;
    }
}
