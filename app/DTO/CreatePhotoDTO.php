<?php

namespace App\DTO;

class CreatePhotoDTO
{
    public string $url;

    public function __construct(array $args)
    {
        $this->url = $args['url'];
    }

    public function getArray(): array
    {
        return ['url' => $this->url];
    }
}
