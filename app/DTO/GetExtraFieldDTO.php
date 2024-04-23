<?php

namespace App\DTO;

class GetExtraFieldDTO
{
    public bool $description = false;
    public bool $photos = false;

    public function __construct(array $fields = [])
    {
        foreach ($fields as $value) {
            $this->{$value} = true;
        }
    }

}
