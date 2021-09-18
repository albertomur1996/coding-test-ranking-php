<?php

namespace App\Infrastructure\Services;

/**
 * Se encarga de guardar el array de anuncios en un fichero JSON
 */
class ToJsonFileAdsSaver {
    /**
     *  Nombre del fichero donde se almacenan los anuncios
     */
    const ADS_FILE = "ads.json";

    /**
     * Transforma el array de objetos anuncio en un array almacenable en un fichero JSON
     *
     * @param array $ads
     */
    public function execute(array $ads) : void {
        $result = [];

        foreach ($ads as $ad) {
            $new_ad = [
                "id" => $ad->getId(),
                "pictures" => $ad->getPictures(),
                "description" => $ad->getDescription(),
                "property_size" => $ad->getPropertySize(),
                "score" => $ad->getScore(),
                "irrelevant_since" => $ad->getIrrelevantSince()];

            if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityChalet") == 0) {
                $new_ad["garden_size"] = $ad->getGardenSize();
                $new_ad["typology"] = "Chalet";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityFlat") == 0) {
                $new_ad["typology"] = "Flat";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityGarage") == 0) {
                $new_ad["typology"] = "Garage";
            }

            array_push($result, $new_ad);
        }

        file_put_contents(self::ADS_FILE, json_encode($result, JSON_UNESCAPED_UNICODE));
    }
}