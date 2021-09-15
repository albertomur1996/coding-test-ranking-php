<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\entities\QualityChalet;
use App\Domain\entities\QualityFlat;
use App\Domain\entities\QualityGarage;
use App\Domain\Picture;
use App\Domain\entities\QualityAd;
use App\Domain\services\PictureMother;

final class InFileSystemAdRepository implements \AdRepository
{
    private array $ads = [];
    private array $pictures = [];

    public function __construct(private PictureMother $picture_generator)
    {
        foreach (range(0,7) as $i) array_push($this->pictures, $this->picture_generator->execute());

        $this->ads['1'] = new QualityChalet(1, $this->pictures[0], 'Este piso es una ganga, compra, compra, COMPRA!!!!!',300, 0, null, null);
        $this->ads['2'] = new QualityFlat(2, $this->pictures[1], 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', 300, 0, null);
        $this->ads['3'] = new QualityChalet(3, $this->pictures[2], '', 300, 0, null, null);
        $this->ads['4'] = new QualityFlat(4, $this->pictures[3], 'Ático céntrico muy luminoso y recién reformado, parece nuevo', 300, 0, null);
        $this->ads['5'] = new QualityFlat(5, $this->pictures[4], 'Pisazo,', 300, 0, null);
        $this->ads['6'] = new QualityGarage(6, $this->pictures[5], '', 300, 0, null);
        $this->ads['7'] = new QualityGarage(7, $this->pictures[6], 'Garaje en el centro de Albacete', 300, 0, null);
        $this->ads['8'] = new QualityChalet(8, $this->pictures[7], 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', 300, 0, null, null);
    }

    public function find_all() : array
    {
        return $this->ads;
    }

    public function save(QualityAd $new_ad) : void {
        $this->ads[$new_ad->getId()] = $new_ad;
    }
}
