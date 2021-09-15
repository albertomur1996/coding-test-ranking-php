<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\application\usecase\ShowPropertiesToBusinessUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QualityListingController
{
    public function __construct(
        private ShowPropertiesToBusinessUseCase $show_properties_to_business_use_case
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $ads = $this->show_properties_to_business_use_case->execute();

        return new JsonResponse($ads);
    }
}
