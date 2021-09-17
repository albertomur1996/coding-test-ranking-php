<?php

namespace  App\Domain\services;

/**
 * Servicio de dominio encargado de ordenar los anuncios de mayor a menor puntuación
 */
class AdSorter
{
    /**
     * Devuelve un array de anuncios ordenador de mayor a menor puntuación
     *
     * @param array $ads
     * @return array
     */
    public function execute(array $ads) : array {
        usort($ads, fn($ad1, $ad2) => $ad2->score <=> $ad1->score);

        return $ads;
    }
}