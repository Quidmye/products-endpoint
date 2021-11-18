<?php

namespace Quidmye\ProductsEndpoint\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Quidmye\ProductsEndpoint\App\Jobs\Products\CreateYMLFile;
use Quidmye\ProductsEndpoint\App\Models\Products\ProductsFormatting;
use Tests\TestCase;

class ProductFormatStartTest extends TestCase
{
    use DatabaseMigrations;

    public function test_status_ok()
    {

        $this->expectsJobs(CreateYMLFile::class);

        $response = $this->post('/api/v1/products/format/', [
            'products' => [
                [
                    'name' => 'TEST NAME',
                    'price' => 9.99,
                    'image' => 'https://cs14.pikabu.ru/post_img/2021/11/18/1/1637192346191955871.jpg',
                    'category' => 'Category'
                ]
            ]
        ]);

        $response->assertStatus(200);

        $responseCreated = $this->get('/api/v1/products/format/1');
        $responseCreated->assertStatus(202);

    }

    public function test_status_fail()
    {
        $response = $this->post('/api/v1/products/format/', [
            'products' => [
                [
                    'name' => '',
                    'price' => 9.99,
                    'image' => 'https://cs14.pikabu.ru/post_img/2021/11/18/1/1637192346191955871.jpg',
                    'category' => 'Category'
                ]
            ]
        ]);

        $response->assertStatus(302);
    }

}
