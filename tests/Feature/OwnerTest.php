<?php

namespace Tests\Feature;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;

    private $data = [
        'name' => 'rizkyowner',
        'email' => 'rizkyrmsyah@owner.com',
        'phone' => '08991727278333',
        'password' => '123123',
        'password_confirmation' => '123123',
    ];

    public function test_register_owner()
    {
        $response = $this->post('/api/owner/register', $this->data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('owners', [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'phone' => $this->data['phone'],
        ]);
    }

    public function test_login()
    {
        $owner = Owner::factory()->create();
        $data = [
            'phone' => $owner->phone,
            'password' => 'test123',
        ];

        $response = $this->post('/api/owner/login', $data);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_authenticated_owner()
    {
        $owner = Owner::factory()->create();
        $data = [
            'phone' => $owner->phone,
            'password' => 'test123',
        ];
        $owner = $this->post('/api/owner/login', $data);

        $accessToken = json_decode($owner->getContent(), true)['data']['access_token'];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $accessToken])->get('/api/owner/show-profile');
        $response->assertStatus(Response::HTTP_OK);
    }
}
