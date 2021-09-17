<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\UseCases\CalculateScoreUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Se limita a hacer uso exclusivamente de las clases de casos de uso para así tener un controlador lo más limpio posible.
 *
 * Las clases de casos de uso se encargarán de orquestar los servicios de dominio necesarios para completar la petición
 */
final class CalculateScoreController
{
    /**
     * @param CalculateScoreUseCase $calculate_score_use_case
     */
    public function __construct(
        private CalculateScoreUseCase $calculate_score_use_case
    )
    {
    }

    /**
     * Calcula la puntuación de todos los anuncios almacenados
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $this->calculate_score_use_case->execute();

        return new JsonResponse(["status" => "The score has been updated for all the ads."]);
    }
}
