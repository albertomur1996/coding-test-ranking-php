<?php

namespace App\application\usecase;

use App\Domain\services\AdLoader;
use App\Domain\services\QualityAdFilter;

class ShowPropertiesToBusinessUseCase
{
    public function __construct(
        private AdLoader $ad_loader,
        private QualityAdFilter $ad_filter
    )
    {
    }

    public function execute() : array {
        $ads = $this->ad_loader->execute();
        return $this->ad_filter->execute($ads);
    }
}