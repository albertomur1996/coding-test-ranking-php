<?php

declare(strict_types=1);

namespace App\Domain\entities\ads;

/**
 * La clase fue creada, en sustitución al atributo typology, debido a que no todos los tipos de propiedades
 * inmobiliarias tienen las mismas características.
 *
 * Se ha creído más conveniente esta aproximación para aportar
 * mayor legibilidad al no mezclar atributos de diferentes tipos de inmuebles en la misma clase
 */
final class QualityFlat extends QualityAd
{
    /**
     * @param $id
     * @param $pictures
     * @param $description
     * @param $property_size
     * @param $score
     * @param $irrelevantSince
     */
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
