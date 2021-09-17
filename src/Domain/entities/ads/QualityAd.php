<?php

declare(strict_types=1);

namespace App\Domain\entities;

use DateTimeImmutable;

/**
 * Extiende el anuncio base para añadir comportamiento y atributos específicos
 */
class QualityAd extends BaseAd
{
    /**
     * Es la puntuación mínima usada para determinar si un anuncio es relevante o no
     */
    const MIN_SCORE = 40;
    /**
     * Zona horaria usada para que el atributo $irrelevantSince muestre la hora correctamente.
     * Si no se utiliza, la hora que queda es 2 horas menor que la hora correspondiente
     */
    const TIMEZONE = 'Europe/Madrid';

    /**
     * @param $id
     * @param $pictures
     * @param $description
     * @param $property_size
     * @param int|null $score
     * @param DateTimeImmutable|null $irrelevantSince
     */
    public function __construct(
        $id,
        $pictures,
        $description,
        $property_size,
        public ?int $score = null,
        private ?DateTimeImmutable $irrelevantSince = null,
    ) {
        parent::__construct($id, $pictures, $description, $property_size);
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @param int|null $score
     */
    public function setScore(?int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getIrrelevantSince(): ?DateTimeImmutable
    {
        return $this->irrelevantSince;
    }

    /**
     * Usa la fecha/hora actuales como momento desde el cual el anuncio es irrelevante
     */
    public function setIrrelevantDateNow(): void {
        date_default_timezone_set(self::TIMEZONE);
        $this->irrelevantSince = date_create_immutable();
    }

    /**
     * Marca la fecha de irrelevancia como nula
     */
    public function clearIrrelevantDate() : void {
        $this->irrelevantSince = null;
    }

    /**
     * Comprueba si un anuncio es relevante en función de la puntuación mínima establecida
     *
     * @return bool
     */
    public function is_relevant() : bool {
        return $this->score != null && $this->score >= self::MIN_SCORE;
    }


    /**
     * Empleada para poder pintar el anuncio correctamente
     *
     * @return false|string
     */
    public function __toString(){
        return json_encode($this);
    }
}
