<?php

namespace App\application\usecase;

use App\Domain\services\AdLoader;
use App\Domain\services\ScoreCalculator;
use App\Domain\services\AdSaver;

class CalculateScoreUseCase
{
    public function __construct(
        private AdLoader $ad_loader,
        private ScoreCalculator $score_calculator,
        private AdSaver $ad_saver)
    {
    }

    public function execute() : void {
        $ads = $this->ad_loader->execute();
        $ads = $this->score_calculator->execute($ads);
        array_map("$this->ad_saver->execute", $ads);
    }
}