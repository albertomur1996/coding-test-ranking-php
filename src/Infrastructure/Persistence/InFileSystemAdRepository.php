<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\entities\QualityChalet;
use App\Domain\entities\QualityFlat;
use App\Domain\entities\QualityGarage;
use App\Domain\entities\QualityAd;
use App\Domain\Picture;
use App\Domain\services\PictureMother;
use DateTimeImmutable;

final class InFileSystemAdRepository implements \AdRepository
{
    const ADS_FILE = "ads.json";

    public function __construct(
        private PictureMother $picture_generator,
        private array $ads = []
    )
    {
        if (!file_exists(self::ADS_FILE)) {
            $this->init_data();
        } else {
            $this->load_data();
        }
    }

    public function find_all() : array
    {
        return $this->ads;
    }

    public function save(QualityAd $new_ad) : void {
        $this->ads[$new_ad->getId()] = $new_ad;
        $this->to_file();
    }

    private function init_data() : void {
        $pictures = [];

        foreach (range(0,7) as $i) array_push($pictures, $this->picture_generator->execute());

        $this->ads[1] = new QualityChalet(1, $pictures[0], 'Este piso es una ganga, compra, compra, COMPRA!!!!!',300, 0, null, 123);
        $this->ads[2] = new QualityFlat(2, $pictures[1], 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', 300, 0, null);
        $this->ads[3] = new QualityChalet(3, $pictures[2], '', 300, 0, null, null);
        $this->ads[4] = new QualityFlat(4, $pictures[3], 'Ático céntrico muy luminoso y recién reformado, parece nuevo', 300, 0, null);
        $this->ads[5] = new QualityFlat(5, $pictures[4], 'Pisazo,', 300, 0, null);
        $this->ads[6] = new QualityGarage(6, $pictures[5], '', 300, 0, null);
        $this->ads[7] = new QualityGarage(7, $pictures[6], 'Garaje en el centro de Albacete', 300, 0, null);
        $this->ads[8] = new QualityChalet(8, $pictures[7], 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', 300, 0, null, null);

        $this->to_file();
    }

    private function load_data() : void {
        $tmp_ads = json_decode(file_get_contents(self::ADS_FILE), true);

        foreach ($tmp_ads as $tmp_ad) {
            $date = null;

            if ($tmp_ad["score"] < 40 && $tmp_ad["irrelevant_since"]) {
                $date = DateTimeImmutable::__set_state($tmp_ad["irrelevant_since"]);
            }

            $this->ads[$tmp_ad["id"]] = match ($tmp_ad["typology"]) {
                "Chalet" => new QualityChalet($tmp_ad["id"], $this->cast_pictures_array($tmp_ad["pictures"]), $tmp_ad["description"], $tmp_ad["property_size"], $tmp_ad["score"], $date, $tmp_ad["garden_size"]),
                "Flat" => new QualityFlat($tmp_ad["id"], $this->cast_pictures_array($tmp_ad["pictures"]), $tmp_ad["description"], $tmp_ad["property_size"], $tmp_ad["score"], $date),
                "Garage" => new QualityGarage($tmp_ad["id"], $this->cast_pictures_array($tmp_ad["pictures"]), $tmp_ad["description"], $tmp_ad["property_size"], $tmp_ad["score"], $date),
            };
        }
    }

    private function to_file() : void {
        $result = [];

        foreach ($this->ads as $ad) {
            $new_ad = [
                "id" => $ad->getId(),
                "pictures" => $ad->getPictures(),
                "description" => $ad->getDescription(),
                "property_size" => $ad->getPropertySize(),
                "score" => $ad->getScore(),
                "irrelevant_since" => $ad->getIrrelevantSince()];

            if (strcmp(get_class($ad), "App\Domain\\entities\QualityChalet") == 0) {
                $new_ad["garden_size"] = $ad->getGardenSize();
                $new_ad["typology"] = "Chalet";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\QualityFlat") == 0) {
                $new_ad["typology"] = "Flat";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\QualityGarage") == 0) {
                $new_ad["typology"] = "Garage";
            }

            array_push($result, $new_ad);
        }

        file_put_contents(self::ADS_FILE, json_encode($result, JSON_UNESCAPED_UNICODE));
    }

    private function cast_pictures_array(array $pictures) : array {
        $result = [];

        foreach ($pictures as $picture) {
            array_push($result, new Picture($picture["id"], $picture["url"], $picture["quality"]));
        }

        return $result;
    }
}
