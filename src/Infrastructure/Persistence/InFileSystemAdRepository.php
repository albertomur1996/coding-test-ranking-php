<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\entities\QualityAd;
use App\Infrastructure\Services\ToJsonFileAdsSaver;
use App\Infrastructure\Services\FromJsonFileAdsLoader;
use App\Infrastructure\Services\AdsGenerator;
use AdRepository;

/**
 * Gestiona el almacenamiento, en un fichero de texto con formato JSON, de los anuncios
 */
final class InFileSystemAdRepository implements AdRepository
{
    /**
     *  Nombre del fichero donde se almacenan los anuncios
     */
    const ADS_FILE = "ads.json";

    /**
     * @param ToJsonFileAdsSaver $ads_saver
     * @param FromJsonFileAdsLoader $ads_loader
     * @param AdsGenerator $ads_generator
     * @param array $ads
     */
    public function __construct(
        private ToJsonFileAdsSaver $ads_saver,
        private FromJsonFileAdsLoader $ads_loader,
        private AdsGenerator $ads_generator,
        private array $ads = []
    )
    {
        if (!file_exists(self::ADS_FILE)) {
            /**
             * Dado que este método solo se llama si el fichero no existe, si se realizan cambios en el servicio de
             * generación de anuncios, el fichero deberá ser borrado si se quieren ver dichos cambios
             */
            $this->init_data();
        } else {
            $this->ads = $this->ads_loader->execute();
        }
    }

    /**
     * Devuelve todos los anuncios almacenados
     *
     * @return array
     */
    public function find_all() : array
    {
        return $this->ads;
    }

    /**
     * Guarda el anuncio especificado
     *
     * @param QualityAd $new_ad
     */
    public function save(QualityAd $new_ad) : void {
        $this->ads[$new_ad->getId()] = $new_ad;
        $this->ads_saver->execute($this->ads);
    }

    /**
     * La inicialización de los datos comprende varios pasos:
     *      1º: Genera un array de anuncios y lo almacena en la variable $ads de esta clase
     *      2º: Almacena los anuncios generados en el fichero de texto
     *
     * Hay que tener presente que este método solo será llamado si el fichero no existe.
     */
    private function init_data() : void {
        $this->ads = $this->ads_generator->execute();

        $this->ads_saver->execute($this->ads);
    }
}
