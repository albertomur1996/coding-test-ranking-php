<?php

namespace App\application\usecase;

use App\Domain\services\AdLoader;
use App\Domain\services\PublicAdFilter;
use App\Domain\services\AdSorter;
use App\Domain\services\CustomerAdTransformer;

class ShowPropertiesToCustomerUseCase
{
    public function __construct(
        private AdLoader $ad_loader,
        private PublicAdFilter $public_ad_filter,
        private AdSorter $ad_sorter,
        private CustomerAdTransformer $ad_transformer
    )
    {
    }

    public function execute() : array {
        $ads = $this->ad_loader->execute();
        $ads = $this->public_ad_filter->execute($ads);

        $ads = $this->ad_sorter->execute($ads);
        return $this->ad_transformer->execute($ads);
    }
}