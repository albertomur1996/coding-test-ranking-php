<?php

namespace  App\Domain\services;

use AdRepository;

/**
 * Servicio de dominio encargado de devolver todos los anuncios almacenados en el repositorio
 */
class AdLoader
{
    /**
     * La implementación está inyectada a través del fichero de configuración de servicios (dentro
     * de este proyecto) de Symfony
     *
     * @param AdRepository $ad_repository
     */
    public function __construct(private AdRepository $ad_repository) {}

    /**
     * Devuelve todos los anuncios almacenados en el repositorio
     *
     * @return array
     */
    public function execute() : array {
        return $this->ad_repository->find_all();
    }
}