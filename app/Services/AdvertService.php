<?php

namespace App\Services;

use App\DTO\CreateAdvertDTO;
use App\DTO\GetExtraFieldDTO;
use App\DTO\SortDTO;
use App\Models\Advert;
use Illuminate\Pagination\LengthAwarePaginator;

class AdvertService
{
    public function store(CreateAdvertDTO $advertDTO): Advert
    {
        $advert = Advert::create($advertDTO->getArray());

        (new PhotoService())->storeForAdvert($advert->id, $advertDTO->photos);

        return $advert;
    }

    public function getById(int $id, GetExtraFieldDTO $extraFieldDTO): Advert
    {
        $query = Advert::select('id', 'name', 'price')
            ->with('mainPhoto:id,advert_id,url');

        if ($extraFieldDTO->description)
            $query = $query->addSelect('description');

        if($extraFieldDTO->photos)
            $query = $query->with('photos:id,advert_id,url');

        return $query->findOrFail($id);
    }

    public function getAll(SortDTO $sortDTO): LengthAwarePaginator
    {
        return Advert::select('id', 'name', 'price')
            ->with('mainPhoto:id,advert_id,url')
            ->orderBy($sortDTO->field, $sortDTO->order)
            ->paginate(10)
            ->withQueryString();
    }

}
