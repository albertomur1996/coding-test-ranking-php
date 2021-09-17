<?php

declare(strict_types=1);

namespace App\Domain\entities;

use JsonSerializable;

/**
 * Clase que representa a cualquiera de las fotos de un anuncio
 */
final class Picture implements JsonSerializable
{
    /**
     * @param int $id
     * @param String $url
     * @param String $quality
     */
    public function __construct(
        private int $id,
        private String $url,
        private String $quality,
    ) {
    }

    /**
     * Comprueba si una foto es en alta definición o no
     *
     * @return bool
     */
    public function is_hd() : bool {
        $result = true;

        if (strcmp($this->quality, "HD") == 0) $result = true;
        else if (strcmp($this->quality, "SD") == 0) $result = false;

        return $result;
    }

    /**
     * Permite guardar la información de una foto en formato JSON, útil a la hora de volcar
     * la información de los anuncios en el fichero de texto
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return ["id" => $this->id, "url" => $this->url, "quality" => $this->quality];
    }
}
