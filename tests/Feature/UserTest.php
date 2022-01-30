<?php

namespace Tests\Feature;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $data = [
        'name' => 'rizkytest',
        'email' => 'rizkyrmsyah@gmail.com',
        'phone' => '0880123123123',
        'password' => '123123',
        'password_confirmation' => '123123',
    ];

    public function test_register_regular_user()
    {
        $data = $this->data;
        $data['type'] = UserTypeEnum::regular();

        $response = $this->post('/api/user/register', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => UserTypeEnum::regular(),
            'credit' => 20,
        ]);
    }

    public function test_register_premium_user()
    {
        $data = $this->data;
        $data['type'] = UserTypeEnum::premium();

        $response = $this->post('/api/user/register', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => UserTypeEnum::premium(),
            'credit' => 40,
        ]);
    }

    public function test_login()
    {
        $user = User::factory()->create();
        $data = [
            'phone' => $user->phone,
            'password' => 'test123',
        ];

        $response = $this->post('/api/user/login', $data);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_authenticated_user()
    {
        $user = User::factory()->create();
        $data = [
            'phone' => $user->phone,
            'password' => 'test123',
        ];
        $user = $this->post('/api/user/login', $data);

        $accessToken = json_decode($user->getContent(), true)['data']['access_token'];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $accessToken])->get('/api/user/show-profile');
        $response->assertStatus(Response::HTTP_OK);
    }
}
