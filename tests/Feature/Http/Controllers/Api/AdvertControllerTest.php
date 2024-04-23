<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Advert;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AdvertControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $adverts = Advert::factory()
            ->count(13)
            ->has(Photo::factory()->count(3))
            ->create();

        $response = $this->getJson('/api/adverts');

        $response->assertJsonCount(10, 'data')
            ->assertJson(fn (AssertableJson $json) =>
            $json->whereAllType([
                'meta' => 'array',
                'links' => 'array',
                'data.0.name' => 'string',
                'data.0.id' => 'integer',
                'data.0.price' => 'integer',
                'data.0.main_photo.id' => 'integer',
                'data.0.main_photo.advert_id' => 'integer',
                'data.0.main_photo.url' => 'string',
                ])
            )->assertOk();
    }

    public function testStore(): void
    {
        $data = [
            'name' => 'Name',
            'description' => 'Description',
            'price' => 3,
            'photos' => [
                'https://picsum.photos/300/100',
                'https://picsum.photos/300/200',
                'https://picsum.photos/300/300'
            ],
        ];

        $response = $this->postJson('/api/adverts', $data);

        $response
            ->assertCreated()
            ->assertJson([
                'message' => 'Объявление создано',
            ])
            ->assertJsonPath('data.id', fn (int $id) => is_int($id));

    }

    public function testShow(): void
    {
        $adverts = Advert::factory()
            ->count(1)
            ->has(Photo::factory()->count(3))
            ->create();

        $response = $this->getJson("/api/adverts/{$adverts[0]->id}");

        $response->assertJson(fn (AssertableJson $json) =>
            $json->whereAllType([
                'data.name' => 'string',
                'data.id' => 'integer',
                'data.price' => 'integer',
                'data.main_photo.id' => 'integer',
                'data.main_photo.advert_id' => 'integer',
                'data.main_photo.url' => 'string',
            ])
            )->assertOk();
    }

    public function testShowWithDescription(): void
    {
        $adverts = Advert::factory()
            ->count(1)
            ->has(Photo::factory()->count(3))
            ->create();

        $response = $this->getJson("/api/adverts/{$adverts[0]->id}/?fields[0]=description");

        $response->assertJson(fn (AssertableJson $json) =>
        $json->whereAllType([
            'data.name' => 'string',
            'data.description' => 'string',
            'data.id' => 'integer',
            'data.price' => 'integer',
            'data.main_photo.id' => 'integer',
            'data.main_photo.advert_id' => 'integer',
            'data.main_photo.url' => 'string',
        ])
        )->assertOk();
    }

    public function testShowWithPhotos(): void
    {
        $adverts = Advert::factory()
            ->count(1)
            ->has(Photo::factory()->count(3))
            ->create();

        $response = $this->getJson("/api/adverts/{$adverts[0]->id}/?fields[0]=photos");

        $response->assertJsonCount(3, 'data.photos')
            ->assertJson(fn (AssertableJson $json) =>
        $json->whereAllType([
            'data.name' => 'string',
            'data.id' => 'integer',
            'data.price' => 'integer',
            'data.main_photo.id' => 'integer',
            'data.main_photo.advert_id' => 'integer',
            'data.main_photo.url' => 'string',
            'data.photos.0.url' => 'string',
            'data.photos.0.advert_id' => 'integer',
            'data.photos.0.id' => 'integer',
        ])
        )->assertOk();
    }

    public function testShowWithAllFields(): void
    {
        $adverts = Advert::factory()
            ->count(1)
            ->has(Photo::factory()->count(3))
            ->create();

        $response = $this->getJson("/api/adverts/{$adverts[0]->id}/?fields[0]=description&fields[1]=photos");

        $response->assertJsonCount(3, 'data.photos')
            ->assertJson(fn (AssertableJson $json) =>
            $json->whereAllType([
                'data.name' => 'string',
                'data.description' => 'string',
                'data.id' => 'integer',
                'data.price' => 'integer',
                'data.main_photo.id' => 'integer',
                'data.main_photo.advert_id' => 'integer',
                'data.main_photo.url' => 'string',
                'data.photos.0.url' => 'string',
                'data.photos.0.advert_id' => 'integer',
                'data.photos.0.id' => 'integer',
            ])
            )->assertOk();
    }

}
