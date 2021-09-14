<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Picture;
use App\Domain\entities\QualityAd;

final class InFileSystemAdRepository implements \AdRepository
{
    private array $ads = [];
    private array $pictures = [];

    public function __construct()
    {
        array_push($this->ads, new QualityAd(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, 0, null));
        array_push($this->ads, new QualityAd(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, 0, null));
        array_push($this->ads, new QualityAd(3, 'CHALET', '', [2], 300, null, 0, null));
        array_push($this->ads, new QualityAd(4, 'FLAT', 'Ático céntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, 0, null));
        array_push($this->ads, new QualityAd(5, 'FLAT', 'Pisazo,', [3, 8], 300, null, 0, null));
        array_push($this->ads, new QualityAd(6, 'GARAGE', '', [6], 300, null, 0, null));
        array_push($this->ads, new QualityAd(7, 'GARAGE', 'Garaje en el centro de Albacete', [], 300, null, 0, null));
        array_push($this->ads, new QualityAd(8, 'CHALET', 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', [1, 7], 300, null, 0, null));

        array_push($this->pictures, new Picture(1, 'https://www.idealista.com/pictures/1', 'SD'));
        array_push($this->pictures, new Picture(2, 'https://www.idealista.com/pictures/2', 'HD'));
        array_push($this->pictures, new Picture(3, 'https://www.idealista.com/pictures/3', 'SD'));
        array_push($this->pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
        array_push($this->pictures, new Picture(5, 'https://www.idealista.com/pictures/5', 'SD'));
        array_push($this->pictures, new Picture(6, 'https://www.idealista.com/pictures/6', 'SD'));
        array_push($this->pictures, new Picture(7, 'https://www.idealista.com/pictures/7', 'SD'));
        array_push($this->pictures, new Picture(8, 'https://www.idealista.com/pictures/8', 'HD'));
    }

    public function find_all(): array
    {
        return $this->ads;
    }


}
