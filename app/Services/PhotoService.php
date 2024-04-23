<?php

namespace App\Services;

use App\DTO\CreatePhotoDTO;
use App\Models\Photo;

class PhotoService
{
    public function storeForAdvert(int $advertId, array $photoDTOs): array
    {
        $photos = [];

        foreach ($photoDTOs as $photoDTO) {
            $photos[] = $this->store($advertId, $photoDTO);
        }
        return $photos;
    }

    public function store(int $advertId, CreatePhotoDTO $photoDTO): Photo
    {
        return Photo::create(['advert_id' => $advertId, ...$photoDTO->getArray()]);
    }
}
