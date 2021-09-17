<?php

namespace  App\Domain\services;

use App\Domain\entities\QualityAd;

/**
 * Servicio de dominio encargado de filtrar un array de anuncios y devolver solo aquellos que sean relevantes
 */
class PublicAdFilter
{
    /**
     * Filtra y devuelve un array de anuncios relevantes
     *
     * @param array $ads
     * @return array
     */
    function execute(array $ads) : array
    {
        $result = [];

        foreach ($ads as $ad) {
            /* @var $ad QualityAd */
            if ($ad->is_relevant()) {
                array_push($result, $ad);
            }
        }

        return $result;
    }
}