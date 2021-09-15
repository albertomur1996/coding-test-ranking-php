<?php

namespace  App\Domain\services;

use App\Domain\entities\QualityAd;

class PublicAdFilter
{
    function execute(array $ads) : array
    {
        $result = [];

        foreach ($ads as $ad) {
            print($ad);
            /* @var $ad QualityAd */
            if ($ad->is_relevant()) {
                array_push($result, $ad);
            }
        }

        return $result;
    }
}