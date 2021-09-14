<?php

use App\Domain\entities\QualityAd;

class QualityAdFilter
{
    function execute(array $ads) : array
    {
        $result = [];

        foreach ($ads as $ad) {
            /* @var $ad QualityAd */
            if (!$ad->is_relevant()) {
                array_push($result, $ad);
            }
        }

        return $result;
    }
}