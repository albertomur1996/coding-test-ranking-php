<?php

class AdSorter
{
    public function execute(array $ads) {
        usort($ads, fn($ad1, $ad2) => $ad1->score <=> $ad2->score);

        return $ads;
    }
}