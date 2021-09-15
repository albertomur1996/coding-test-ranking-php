<?php

namespace  App\Domain\services;

use AdRepository;
use \App\Domain\entities\QualityAd;

class AdSaver
{
    public function __construct(private AdRepository $ad_repository) {}

    public function execute(QualityAd $new_ad) : void {
        $this->ad_repository->save($new_ad);
    }
}