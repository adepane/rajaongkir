<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RajaOngkirApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_access_without_credential(): void
    {
        $response = $this->get('/api/search/provinces');

        $response->assertStatus(401);
        $response->assertSee('Unauthenticated');
    }

    /**
     * @test
     */
    public function user_access_all_provinces(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get('/api/search/provinces?swap=db');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_access_query_province_by_id(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get('/api/search/provinces?id=12&?swap=db');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_access_all_cities(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get('/api/search/cities?swap=db');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_access_query_city_by_id(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get('/api/search/cities?id=12?swap=db');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_fetch_direct_provinces_from_raja_ongkir()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->get('/api/search/provinces?id=12&swap=direct');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_fetch_direct_cities_from_raja_ongkir()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->get('/api/search/cities?id=12&swap=direct');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'rajaongkir' => [
                'query' => [],
                'status' => ['code', 'description'],
                'results' => [],
            ],
        ]);
    }
}
