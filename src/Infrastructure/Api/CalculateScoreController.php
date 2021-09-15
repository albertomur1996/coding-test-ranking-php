<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use CalculateScoreUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CalculateScoreController
{
    public function __construct(
        private CalculateScoreUseCase $calculate_score_use_case
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $this->calculate_score_use_case->execute();

        return new JsonResponse([]);
    }
}
