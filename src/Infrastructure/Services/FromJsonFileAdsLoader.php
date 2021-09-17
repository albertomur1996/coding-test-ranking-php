<?php

namespace App\Infrastructure\Services;

use App\Domain\entities\QualityChalet;
use App\Domain\entities\QualityFlat;
use App\Domain\entities\QualityGarage;
use DateTimeImmutable;

/**
 * Se encarga de leer el fichero JSON, donde están los anuncios almacenados, y transformarlo en un array de anuncios
 */
class FromJsonFileAdsLoader {
    /**
     *  Nombre del fichero donde se almacenan los anuncios
     */
    const ADS_FILE = "ads.json";

    /**
     * @param FromFilePicturesReader $pictures_reader
     */
    public function __construct(
        private FromFilePicturesReader $pictures_reader
    )
    {
    }

    /**
     * Lee el contenido del fichero JSON para transformar la información de nuevo a objetos anuncio
     * (fotografías incluidas)
     *
     * @return array
     */
    public function execute() : array {
        $tmp_ads = json_decode(file_get_contents(self::ADS_FILE), true);
        $ads = [];

        foreach ($tmp_ads as $tmp_ad) {
            $date = null;

            if ($tmp_ad["score"] < 40 && $tmp_ad["irrelevant_since"]) {
                $date = DateTimeImmutable::__set_state($tmp_ad["irrelevant_since"]);
            }
            $description = mb_convert_encoding($tmp_ad["description"], 'UTF-8', 'UTF-8');

            $ads[$tmp_ad["id"]] = match ($tmp_ad["typology"]) {
                "Chalet" => new QualityChalet($tmp_ad["id"], $this->pictures_reader->execute($tmp_ad["pictures"]), $description, $tmp_ad["property_size"], $tmp_ad["score"], $date, $tmp_ad["garden_size"]),
                "Flat" => new QualityFlat($tmp_ad["id"], $this->pictures_reader->execute($tmp_ad["pictures"]), $description, $tmp_ad["property_size"], $tmp_ad["score"], $date),
                "Garage" => new QualityGarage($tmp_ad["id"], $this->pictures_reader->execute($tmp_ad["pictures"]), $description, $tmp_ad["property_size"], $tmp_ad["score"], $date),
            };
        }

        return $ads;
    }
}