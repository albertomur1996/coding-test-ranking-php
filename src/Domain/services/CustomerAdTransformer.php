<?php

namespace  App\Domain\services;

/**
 * Servicio de dominio encargado de transformar los objetos anuncio a una representación tipo array plano.
 *
 * Esta representación es necesaria para mostrar la información correctamente cuando el controlador la devuelve.
 *
 * Los atributos/propiedades devueltos son aquellos que resultan de interés para los clientes
 */
class CustomerAdTransformer
{
    /**
     * Devuelve cada anuncio como si fuera un array plano en vez de una clase que extiende de QualityAd
     *
     * @param array $ads
     * @return array
     */
    public function execute(array $ads) : array {
        $result = [];

        foreach ($ads as $ad) {
            $new_ad = [
                "pictures" => $ad->getPictures(),
                "description" => $ad->getDescription(),
                "property_size" => $ad->getPropertySize()];

            if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityChalet") == 0) {
                $new_ad["garden_size"] = $ad->getGardenSize();
                $new_ad["typology"] = "Chalet";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityFlat") == 0) {
                $new_ad["typology"] = "Flat";
            } else if (strcmp(get_class($ad), "App\Domain\\entities\ads\QualityGarage") == 0) {
                $new_ad["typology"] = "Garage";
            }

            array_push($result, $new_ad);
        }

        return $result;
    }
}