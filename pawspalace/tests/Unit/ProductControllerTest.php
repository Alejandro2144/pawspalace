<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\View\View;

class ProductControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test to verify the index method of ProductController.
     *
     * @return void
     */
    public function test_product_controller_index_method()
    {
        // Arrange
        $controller = new ProductController();
        $request = new Request();

        // Act
        $response = $controller->index($request);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertProductIndexResponse($response);
    }

    /**
     * Test to verify the showFavorites method of ProductController.
     *
     * @return void
     */
    public function test_product_controller_showFavorites_method()
    {
        // Arrange
        $controller = new ProductController();
        $user = User::factory()->create(['balance' => 100]);
        $this->actingAs($user);

        // Act
        $response = $controller->showFavorites();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertShowFavoritesResponse($response);
    }

    /**
     * Asserts the response of the index method.
     *
     * @param \Illuminate\View\View $response
     * @return void
     */
    private function assertProductIndexResponse($response)
    {
        $viewData = $response->getData()['viewData'];
        $this->assertArrayHasKey('title', $viewData);
        $this->assertArrayHasKey('subtitle', $viewData);
        $this->assertArrayHasKey('query', $viewData);
        $this->assertArrayHasKey('category', $viewData);
        $this->assertArrayHasKey('products', $viewData);
    }

    /**
     * Asserts the response of the showFavorites method.
     *
     * @param \Illuminate\View\View $response
     * @return void
     */
    private function assertShowFavoritesResponse($response)
    {
        $viewData = $response->getData();
        $this->assertArrayHasKey('favorites', $viewData);
    }

}
