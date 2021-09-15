<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\application\usecase\ShowPropertiesToCustomerUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PublicListingController
{
    public function __construct(
        private ShowPropertiesToCustomerUseCase $show_properties_to_clients_use_case
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $ads = $this->show_properties_to_clients_use_case->execute();
        return new JsonResponse($ads);
    }
}
