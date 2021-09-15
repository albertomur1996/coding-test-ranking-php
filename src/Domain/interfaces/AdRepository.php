<?php

use \App\Domain\entities\QualityAd;

interface AdRepository {
    public function find_all() : array;
    public function save(QualityAd $new_ad) : void;
}