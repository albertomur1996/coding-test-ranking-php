<?php

namespace  App\Domain\services;

use App\Domain\Picture;

class PictureMother
{
    public function execute() : array {
        $times = rand(1, 5);
        $result = [];

        for ($i = 0; $i < $times; $i++) {
            $picture_id = rand(1, 100);
            $wizard = rand(1, 2);

            if ($wizard == 1) $picture_quality = "SD";
            else $picture_quality = "HD";
            array_push($result, new Picture($picture_id, 'https://www.idealista.com/pictures/' . $picture_id, $picture_quality));
        }

        return $result;
    }
}