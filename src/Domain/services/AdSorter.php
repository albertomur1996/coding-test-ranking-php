<?php

namespace  App\Domain\services;

class AdSorter
{
    public function execute(array $ads) : array {
        usort($ads, fn($ad1, $ad2) => $ad2->score <=> $ad1->score);

        return $ads;
    }
}