<?php

namespace  App\Domain\services;

/**
 * Servicio de dominio encargado de asignar una puntuación a cada anuncio.
 *
 * También asigna la fecha actual como fecha de "irrelevancia" si así le corresponde a un anuncio según su puntuación,
 * o bien elimina la fecha de irrelevancia si la nueva puntuación convierte al anuncio en relevante
 */
class ScoreCalculator
{
    /**
     * Mínima puntuación que un anuncio puede tener
     */
    const MIN_SCORE = 0;
    /**
     * Máxima puntuación que un anuncio puede tener
     */
    const MAX_SCORE = 100;

    /**
     * Calcula la puntuación del anuncio y, según esta puntuación, asigna la fecha actual como fecha de irrelevancia (si
     * el anuncio es irrelevante según la nueva puntuación) o bien elimina la fecha de irrelevancia (si el anuncio es
     * relevante según la nueva puntuación)
     *
     * @param array $ads
     * @return array
     */
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
            $ad->setScore(0);

            /**
             * Cálculo de la puntuación según el criterio fotográfico
             */
            if (sizeof($ad->getPictures()) == 0) {
                $ad->setScore($ad->getScore() - 10);
            } else {
                foreach ($ad->getPictures() as $picture) {
                    if ($picture->is_hd()) {
                        $ad->setScore($ad->getScore() + 20);
                    } else {
                        $ad->setScore($ad->getScore() + 10);
                    }
                }
            }

            /**
             * Cálculo de la puntuación según el criterio de existencia de una descripción
             */
            $wc = str_word_count($ad->getDescription());
            if ($wc > 0) {
                $ad->setScore($ad->getScore() + 5);
            }

            /**
             * Cálculo de la puntuación según el criterio de cantidad de palabras de la descripción
             */
            if (is_a($ad, "QualityFlat")) {
                if ($wc >= 20 && $wc <= 49) $ad->setScore($ad->getScore() + 10);
                else if ($wc >= 50) $ad->setScore($ad->getScore() + 30);
            } elseif (is_a($ad, "QualityChalet")) {
                if ($wc > 50) $ad->setScore($ad->getScore() + 20);
            }

            /**
             * Cálculo de la puntuación según el criterio de aparición de las palabras clave establecidas
             */
            if (str_contains(mb_strtolower($ad->getDescription()), "luminoso")) {
                $ad->setScore($ad->getScore() + 5);
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "nuevo")) {
                $ad->setScore($ad->getScore() + 5);
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "céntrico")) {
                $ad->setScore($ad->getScore() + 5);
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "reformado")) {
                $ad->setScore($ad->getScore() + 5);
            }
            if (str_contains(mb_strtolower($ad->getDescription()), "ático")) {
                $ad->setScore($ad->getScore() + 5);
            }

            /**
             * Comprobación acerca de la completitud del anuncio
             */
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
                $ad->setScore($ad->getScore() + 40);
            }

            /**
             * Limitación de puntuación en caso de que sobrepase alguno de los límites establecidos
             */
            if ($ad->getScore() < self::MIN_SCORE) $ad->setScore(self::MIN_SCORE);
            if ($ad->getScore() > self::MAX_SCORE) $ad->setScore(self::MAX_SCORE);

            /**
             * Comprobación de la relevancia del anuncio
             */
            if (!$ad->is_relevant()) $ad->setIrrelevantDateNow();
            else $ad->clearIrrelevantDate();

            array_push($result, $ad);
        }

        return $result;
    }
}