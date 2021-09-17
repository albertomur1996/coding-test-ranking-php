<?php

namespace App\Application\UseCases;

use App\Domain\services\AdLoader;
use App\Domain\services\QualityAdFilter;
use App\Domain\services\BusinessAdTransformer;

/**
 * Esta clase orquesta la ejecución de los servicios de dominio necesarios
 * para mostrar al encargado de calidad los anuncios de su interés
 */
class ShowPropertiesToBusinessUseCase
{
    /**
     * @param AdLoader $ad_loader
     * @param QualityAdFilter $ad_filter
     * @param BusinessAdTransformer $business_ad_transformer
     */
    public function __construct(
        private AdLoader $ad_loader,
        private QualityAdFilter $ad_filter,
        private BusinessAdTransformer $business_ad_transformer
    )
    {
    }

    /**
     * Este método se encarga de:
     *      1º: Cargar los anuncios almacenados
     *      2º: Filtrar los anuncios cargados para solo conservar los irrelevantes
     *      3º: Transforma los anuncios filtrados para mostrar la información al encargado de calidad
     *
     * @return array Contiene los anuncios irrelevantes que hay almacenados
     */
    public function execute() : array {
        $ads = $this->ad_loader->execute();
        $ads = $this->ad_filter->execute($ads);
        return $this->business_ad_transformer->execute($ads);
    }
}