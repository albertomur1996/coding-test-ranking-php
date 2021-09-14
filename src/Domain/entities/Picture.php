<?php

declare(strict_types=1);

namespace App\Domain;

final class Picture
{
    public function __construct(
        private int $id,
        private String $url,
        private String $quality,
    ) {
    }

    public function is_hd() : bool {
        $result = true;

        if (strcmp($this->quality, "HD")) $result = true;
        else if (strcmp($this->quality, "SD")) $result = false;

        return $result;
    }
}
