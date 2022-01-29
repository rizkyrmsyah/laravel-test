<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ownerMiddleware')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Property::where('owner_id', $request->session->id)
            ->search($request)
            ->order($request)
            ->paginate($request->input('per_page', 10));

        return PropertyResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        Property::create($request->validated() + ['owner_id' => $request->session->id]);
        return response()->json(['message' => 'Tambah properti berhasil'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {
        if ($property->owner_id != $request->session->id) {
            return response()->json(['message' => 'Properti tidak ditemukan'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $property->update($request->validated());
        return response()->json(['message' => 'Ubah properti berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Property $property)
    {
        if ($property->owner_id != $request->session->id) {
            return response()->json(['message' => 'Properti tidak ditemukan'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $property->delete();
        return response()->json(['message' => 'Hapus properti berhasil'], Response::HTTP_NO_CONTENT);
    }
}
