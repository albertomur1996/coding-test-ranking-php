<?php

namespace App\Application\UseCases;

use App\Domain\services\AdLoader;
use App\Domain\services\PublicAdFilter;
use App\Domain\services\AdSorter;
use App\Domain\services\CustomerAdTransformer;

/**
 * Esta clase orquesta la ejecución de los servicios de dominio necesarios
 * para mostrar a los clientes los anuncios relevantes
 */
class ShowPropertiesToCustomerUseCase
{
    /**
     * @param AdLoader $ad_loader
     * @param PublicAdFilter $public_ad_filter
     * @param AdSorter $ad_sorter
     * @param CustomerAdTransformer $ad_transformer
     */
    public function __construct(
        private AdLoader $ad_loader,
        private PublicAdFilter $public_ad_filter,
        private AdSorter $ad_sorter,
        private CustomerAdTransformer $ad_transformer
    )
    {
    }

    /**
     * Este método se encarga de:
     *      1º: Cargar los anuncios almacenados
     *      2º: Filtrar los anuncios cargados para solo conservar los relevantes
     *      3º: Ordena los anuncios para mostrar primero aquellos con puntuaciones mayores
     *      4º: Transforma los anuncios filtrados para mostrar la información de interés a los clientes
     *
     * @return array Contiene los anuncios relevantes que hay almacenados
     */
    public function execute() : array {
        $ads = $this->ad_loader->execute();
        $ads = $this->public_ad_filter->execute($ads);

        $ads = $this->ad_sorter->execute($ads);
        return $this->ad_transformer->execute($ads);
    }
}