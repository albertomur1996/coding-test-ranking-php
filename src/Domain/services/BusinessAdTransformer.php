<?php

namespace  App\Domain\services;

class BusinessAdTransformer
{
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
            $new_ad = [
                "id" => $ad->getId(),
                "pictures" => $ad->getPictures(),
                "description" => $ad->getDescription(),
                "property_size" => $ad->getPropertySize(),
                "score" => $ad->getScore(),
                "irrelevant_since" => $ad->getIrrelevantSince()];

            if (strcmp(get_class($ad), "App\Domain\\entities\QualityChalet") == 0) {
                $new_ad["garden_size"] = $ad->getGardenSize();
            }

            array_push($result, $new_ad);
        }

        return $result;
    }
}