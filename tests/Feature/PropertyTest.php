<?php

namespace Tests\Feature;

use App\Models\Owner;
use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->owner = Owner::factory()->create();
        $data = [
            'phone' => $this->owner->phone,
            'password' => 'test123',
        ];
        $ownerLogin = $this->post('/api/owner/login', $data);
        $this->accessToken = json_decode($ownerLogin->getContent(), true)['data']['access_token'];
    }

    public function test_list_owner_property_using_user_token()
    {
        $user = User::factory()->create();
        $data = [
            'phone' => $user->phone,
            'password' => 'test123',
        ];
        $user = $this->post('/api/user/login', $data);

        $accessToken = json_decode($user->getContent(), true)['data']['access_token'];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $accessToken])->get('/api/property');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_list_owner_property_using_owner_token()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])->get('/api/property');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_property()
    {
        $data = [
            'name' => 'test aja',
            'location' => 'jakarta utara',
            'price' => 500000,
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])->post('/api/property', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('properties', [
            'owner_id' => $this->owner->id,
            'location' => $data['location'],
            'price' => $data['price'],
        ]);
    }

    public function test_edit_property()
    {
        $property = Property::factory()->create();
        $data = [
            'name' => 'test aja',
            'location' => 'jakarta utara',
            'price' => 500000,
        ];

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])->patch("/api/property/$property->id", $data);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('properties', [
            'owner_id' => $this->owner->id,
            'location' => $data['location'],
            'price' => $data['price'],
        ]);
    }

    public function test_delete_property()
    {
        $property = Property::factory()->create();
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])->delete("/api/property/$property->id");
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertSoftDeleted('properties', $property->toArray());
    }

    public function test_show_property()
    {
        $property = Property::factory()->create();
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])->get("/api/property/$property->id");
        $response->assertStatus(Response::HTTP_OK);
    }
}
