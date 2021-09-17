<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\UseCases\ShowPropertiesToBusinessUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Se limita a hacer uso exclusivamente de las clases de casos de uso para así tener un controlador lo más limpio posible.
 *
 * Las clases de casos de uso se encargarán de orquestar los servicios de dominio necesarios para completar la petición
 */
final class QualityListingController
{
    /**
     * @param ShowPropertiesToBusinessUseCase $show_properties_to_business_use_case
     */
    public function __construct(
        private ShowPropertiesToBusinessUseCase $show_properties_to_business_use_case
    )
    {
    }

    /**
     * Devuelve un listado de los anuncios irrelevantes almacenados
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $ads = $this->show_properties_to_business_use_case->execute();

        return new JsonResponse($ads);
    }
}
