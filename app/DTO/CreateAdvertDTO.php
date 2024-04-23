<?php

namespace App\DTO;

class CreateAdvertDTO
{
    public string $name;
    public string $description;
    public int $price;
    public array $photos;

    public function __construct(array $args)
    {
        $this->name = $args['name'];
        $this->description = $args['description'];
        $this->price = $args['price'];

        foreach ($args['photos'] as $photo) {
            $this->photos[] = new CreatePhotoDTO(['url' => $photo]);
        }

    }

    public function getArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];
    }

}
