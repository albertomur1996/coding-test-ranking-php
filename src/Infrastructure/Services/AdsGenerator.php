<?php

namespace App\Infrastructure\Services;

use App\Domain\entities\ads\QualityChalet;
use App\Domain\entities\ads\QualityFlat;
use App\Domain\entities\ads\QualityGarage;
use App\Domain\services\PictureMother;

/**
 * Se encarga de generar anuncios
 */
class AdsGenerator {
    /**
     * @param PictureMother $picture_generator
     */
    public function __construct(
        private PictureMother $picture_generator,
    )
    {
    }

    /**
     * Hace uso del generador de imágenes para, posteriormente, generar un número determinado de anuncios
     *
     * @return array
     */
    public function execute() : array {
        $ads = [];
        $pictures = [];

        foreach (range(0,7) as $i) array_push($pictures, $this->picture_generator->execute());

        $ads[1] = new QualityChalet(1, $pictures[0], 'Este piso es una ganga, compra, compra, COMPRA!!!!!',300, 0, null, 123);
        $ads[2] = new QualityFlat(2, $pictures[1], 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', 300, 0, null);
        $ads[3] = new QualityChalet(3, $pictures[2], '', 300, 0, null, null);
        $ads[4] = new QualityFlat(4, $pictures[3], 'Ático céntrico muy luminoso y recién reformado, parece nuevo', 300, 0, null);
        $ads[5] = new QualityFlat(5, $pictures[4], 'Pisazo,', 300, 0, null);
        $ads[6] = new QualityGarage(6, $pictures[5], '', 300, 0, null);
        $ads[7] = new QualityGarage(7, $pictures[6], 'Garaje en el centro de Albacete', 300, 0, null);
        $ads[8] = new QualityChalet(8, $pictures[7], 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', 300, 0, null, null);

        return $ads;
    }
}