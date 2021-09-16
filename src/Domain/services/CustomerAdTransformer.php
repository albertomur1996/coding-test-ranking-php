<?php

namespace  App\Domain\services;

class CustomerAdTransformer
{
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
            $new_ad = [
                "pictures" => $ad->getPictures(),
                "description" => $ad->getDescription(),
                "property_size" => $ad->getPropertySize(),
                "score" => $ad->getScore()];

            if (strcmp(get_class($ad), "App\Domain\\entities\QualityChalet") == 0) {
                $new_ad["garden_size"] = $ad->getGardenSize();
            }

            array_push($result, $new_ad);
        }

        return $result;
    }
}