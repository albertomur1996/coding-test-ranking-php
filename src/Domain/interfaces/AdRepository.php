<?php

use App\Domain\entities\ads\QualityAd;

/**
 *  Representa las operaciones que cualquier repositorio de anuncios, sin importar el tipo, debe tener
 */
interface AdRepository {
    /**
     * Devuelve en un array todos los anuncios almacenados
     *
     * @return array
     */
    public function find_all() : array;

    /**
     * Permite guardar un anuncio en el repositorio
     *
     * @param QualityAd $new_ad
     */
    public function save(QualityAd $new_ad) : void;
}