<?php

namespace  App\Domain\services;

use App\Domain\entities\BaseAd;

class AdTransformer
{
    public function execute(array $ads) {
        $result = [];

        foreach ($ads as $ad) {
            array_push($result, new BaseAd(
                $ad->id, $ad->typology, $ad->description, $ad->pictureUrls, $ad->houseSize, $ad->gardenSize
            ));
        }

        return $result;
    }
}