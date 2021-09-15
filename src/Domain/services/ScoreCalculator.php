<?php

namespace  App\Domain\services;

use \App\Domain\entities\QualityAd;

class ScoreCalculator
{
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
//            /* @var $ad QualityAd */

            //pictures
            if (sizeof($ad->getPictures()) == 0) {
                $ad->score -= 10;
            } else {
                foreach ($ad->getPictures() as $picture) {
                    if ($picture->is_hd()) {
                        $ad->score += 20;
                    } else {
                        $ad->score += 10;
                    }
                }
            }

            //has description
            if (strlen($ad->getDescription()) > 0) {
                $ad->score += 5;
            }

            //description word count
            $wc = str_word_count($ad->getDescription());
            if (is_a($ad, "QualityFlat")) {
                if ($wc >= 20 && $wc <= 49) $ad->score += 10;
                else if ($wc >= 50) $ad->score += 30;
            } elseif (is_a($ad, "QualityChalet")) {
                if ($wc > 50) $ad->score += 20;
            }

            //check if description contains keywords
            if (str_contains(strtolower($ad->getDescription()), "luminoso")) {
                $ad->score += 5;
            }
            if (str_contains(strtolower($ad->getDescription()), "nuevo")) {
                $ad->score += 5;
            }
            if (str_contains(strtolower($ad->getDescription()), "céntrico")) {
                $ad->score += 5;
            }
            if (str_contains(strtolower($ad->getDescription()), "reformado")) {
                $ad->score += 5;
            }
            if (str_contains(strtolower($ad->getDescription()), "ático")) {
                $ad->score += 5;
            }

            //check if ad is complete
            $is_complete = true;

            if (sizeof($ad->getPictures()) == 0 || $wc <= 0) {
                $is_complete = false;
            }
            if (is_a($ad, "QualityFlat") && $wc <= 0) {
                $is_complete = false;
            }
            if (is_a($ad, "QualityChalet") && ($wc <= 0 || $ad->getGardenSize() <= 0)) {
                $is_complete = false;
            }
            if ($is_complete) $ad->score += 40;

            if ($ad->getScore() >= 0) array_push($result, $ad);
        }

        return $result;
    }
}