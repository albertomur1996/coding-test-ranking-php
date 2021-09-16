<?php

declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;

final class Picture implements JsonSerializable
{
    public function __construct(
        private int $id,
        private String $url,
        private String $quality,
    ) {
    }

    public function is_hd() : bool {
        $result = true;

        if (strcmp($this->quality, "HD") == 0) $result = true;
        else if (strcmp($this->quality, "SD") == 0) $result = false;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return ["id" => $this->id, "url" => $this->url, "quality" => $this->quality];
    }
}
