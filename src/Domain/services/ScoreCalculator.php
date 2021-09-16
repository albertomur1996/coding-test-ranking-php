<?php

namespace  App\Domain\services;

use DateTimeZone;

class ScoreCalculator
{
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
            $ad->score = 0;

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
            $wc = str_word_count($ad->getDescription());
            if ($wc > 0) {
                $ad->score += 5;
            }

            //description word count
            if (is_a($ad, "QualityFlat")) {
                if ($wc >= 20 && $wc <= 49) $ad->score += 10;
                else if ($wc >= 50) $ad->score += 30;
            } elseif (is_a($ad, "QualityChalet")) {
                if ($wc > 50) $ad->score += 20;
            }

            //check if description contains keywords
            if (str_contains(mb_strtolower($ad->getDescription()), "luminoso")) {
                $ad->score += 5;
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "nuevo")) {
                $ad->score += 5;
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "céntrico")) {
                $ad->score += 5;
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "reformado")) {
                $ad->score += 5;
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "ático")) {
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
            if ($is_complete) {
                $ad->score += 40;
            } else {
                date_default_timezone_set('Europe/Madrid');
                $date = date_create_immutable();
                $ad->setIrrelevantSince($date);
            }

            if ($ad->getScore() < 0) $ad->score = 0;
            if ($ad->getScore() > 100) $ad->score = 100;

            array_push($result, $ad);
        }

        return $result;
    }
}