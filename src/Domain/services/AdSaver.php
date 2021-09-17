<?php

namespace  App\Domain\services;

use AdRepository;
use App\Domain\entities\QualityAd;

/**
 * Servicio de dominio encargado de guardar un anuncio en el repositorio
 */
class AdSaver
{
    /**
     * La implementación está inyectada a través del fichero de configuración de servicios (dentro
     * de este proyecto) de Symfony
     *
     * @param AdRepository $ad_repository
     */
    public function __construct(private AdRepository $ad_repository) {}

    /**
     * Guarda el anuncio especificado en el repositorio
     *
     * @param QualityAd $new_ad
     */
    public function execute(QualityAd $new_ad) : void {
        $this->ad_repository->save($new_ad);
    }
}