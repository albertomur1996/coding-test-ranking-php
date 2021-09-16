<?php

namespace App\application\usecase;

use App\Domain\services\AdLoader;
use App\Domain\services\QualityAdFilter;
use App\Domain\services\BusinessAdTransformer;

class ShowPropertiesToBusinessUseCase
{
    public function __construct(
        private AdLoader $ad_loader,
        private QualityAdFilter $ad_filter,
        private BusinessAdTransformer $business_ad_transformer
    )
    {
    }

    public function execute() : array {
        $ads = $this->ad_loader->execute();
        $ads = $this->ad_filter->execute($ads);
        return $this->business_ad_transformer->execute($ads);
    }
}