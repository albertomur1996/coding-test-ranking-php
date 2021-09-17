<?php

namespace App\Infrastructure\Services;

use App\Domain\Picture;

/**
 * Sirve para convertir la información de las fotografías cuando se lee la información del fichero JSON.
 *
 * Esta transformación es necesaria, ya que la información almacenada en el fichero JSON es un array plano y
 * necesitamos convertir dicha información en un array de objetos Picture de nuevo
 */
class FromFilePicturesReader {
    /**
     * Convierte la información de las fotografías desde el formato array plano hasta un array de objetos Picture
     *
     * @param array $pictures
     * @return array
     */
    public function execute(array $pictures) : array {
        $result = [];

        foreach ($pictures as $picture) {
            array_push($result, new Picture($picture["id"], $picture["url"], $picture["quality"]));
        }

        return $result;
    }
}