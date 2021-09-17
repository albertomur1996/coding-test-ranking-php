<?php

namespace  App\Domain\services;

use App\Domain\Picture;

/**
 * Servicio de dominio encargado de generar una imagen aleatoria.
 *
 * Útil para ahorrar código a la hora de generar varios anuncios
 */
class PictureMother
{
    /**
     * Establece el mínimo número de fotos que se pueden generar
     */
    const MIN_PICTURE_COUNT = 1;
    /**
     * Establece el máximo número de fotos que se pueden generar
     */
    const MAX_PICTURE_COUNT = 5;

    /**
     * Devuelve un array con objetos de tipo Picture
     *
     * @return array
     */
    public function execute() : array {
        $times = rand(self::MIN_PICTURE_COUNT - 1, self::MAX_PICTURE_COUNT - 1);
        $result = [];

        for ($i = 0; $i < $times; $i++) {
            $picture_id = rand(1, 100);
            $wizard = rand(1, 2);

            if ($wizard == 1) $picture_quality = "SD";
            else $picture_quality = "HD";
            array_push($result, new Picture($picture_id, 'https://www.idealista.com/pictures/' . $picture_id, $picture_quality));
        }

        return $result;
    }
}