<?php

namespace App\Application\UseCases;

use App\Domain\services\AdLoader;
use App\Domain\services\ScoreCalculator;
use App\Domain\services\AdSaver;

/**
 * Esta clase orquesta la ejecución de los servicios de dominio necesarios
 * para calcular la puntuación de cada anuncio
 */
class CalculateScoreUseCase
{
    /**
     * @param AdLoader $ad_loader
     * @param ScoreCalculator $score_calculator
     * @param AdSaver $ad_saver
     */
    public function __construct(
        private AdLoader $ad_loader,
        private ScoreCalculator $score_calculator,
        private AdSaver $ad_saver)
    {
    }

    /**
     * Este método se encarga de:
     *      1º: Cargar los anuncios almacenados
     *      2º: Calcula la puntuación correspondiente para cada anuncio
     *      3º: Almacena de nuevo todos los anuncios con sus puntuaciones actualizadas
     */
    public function execute() : void {
        $ads = $this->ad_loader->execute();
        $ads = $this->score_calculator->execute($ads);

        foreach ($ads as $ad) $this->ad_saver->execute($ad);
    }
}