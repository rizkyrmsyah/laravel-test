<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskAvailibilityRequest;
use App\Models\Chatroom;
use App\Models\ChatroomDetail;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AskAvailibilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AskAvailibilityRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->session->id);
            $user->credit = $user->credit - 5;
            $user->save();

            $chatroom = Chatroom::create(['user_id' => $request->session->id, 'property_id' => $request->property_id]);
            ChatroomDetail::create(['chatroom_id' => $chatroom->id, 'user_id' => $request->session->id, 'message' => $request->message]);
            DB::commit();
            return response()->json(['message' => 'Tanya ketersediaan berhasil'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan pada sistem'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
