<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateAdvertDTO;
use App\DTO\GetExtraFieldDTO;
use App\DTO\SortDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetFieldsAdvertRequest;
use App\Http\Requests\SortAdvertRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Http\Resources\AdvertCollection;
use App\Http\Resources\AdvertResource;
use App\Services\AdvertService;
use Illuminate\Http\JsonResponse;

class AdvertController extends Controller
{
    public function __construct(private AdvertService $advertService) {}

    public function index(SortAdvertRequest $request): AdvertCollection
    {
        $sortDTO = new SortDTO($request->validated());

        $adverts = $this->advertService->getAll($sortDTO);

        return new AdvertCollection($adverts);
    }

    public function store(StoreAdvertRequest $request): JsonResponse
    {
        $advertDTO = new createAdvertDTO($request->validated());

        $advert = $this->advertService->store($advertDTO);

        return response()->json(['message' => 'Объявление создано','data' => ['id' => $advert->id]], 201);
    }

    public function show(string $id, GetFieldsAdvertRequest $request): AdvertResource
    {
        $advertDTO = new GetExtraFieldDTO(...$request->validated());

        $advert = $this->advertService->getById($id, $advertDTO);

        return new AdvertResource($advert);
    }

}
