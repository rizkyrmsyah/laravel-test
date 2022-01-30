<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AskAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user()
    {
        $userData = User::factory()->create();
        $data = [
            'phone' => $userData->phone,
            'password' => 'test123',
        ];
        $user = $this->post('/api/user/login', $data);

        $property = Property::factory()->create();
        $dataAsk = [
            'property_id' => $property->id,
            'message' => 'apakah ready?',
        ];

        $accessToken = json_decode($user->getContent(), true)['data']['access_token'];
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $accessToken])->post('/api/ask-availibility', $dataAsk);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('chatrooms', [
            'user_id' => $userData->id,
            'property_id' => $dataAsk['property_id'],
        ]);
        $this->assertDatabaseHas('chatroom_details', [
            'user_id' => $userData->id,
            'message' => $dataAsk['message'],
        ]);
    }
}
