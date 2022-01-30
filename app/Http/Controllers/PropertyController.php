<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('ownerMiddleware')->except(['show']);
    }

    public function index(Request $request)
    {
        $query = Property::where('owner_id', $request->session->id)
            ->search($request)
            ->order($request)
            ->paginate($request->input('per_page', 10));

        return PropertyResource::collection($query);
    }

    public function store(PropertyRequest $request)
    {
        Property::create($request->validated() + ['owner_id' => $request->session->id]);

        return response()->json(['message' => 'Tambah properti berhasil'], Response::HTTP_CREATED);
    }

    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    public function update(PropertyRequest $request, Property $property)
    {
        if ($property->owner_id != $request->session->id) {
            return response()->json(['message' => 'Properti tidak ditemukan'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $property->update($request->validated());

        return response()->json(['message' => 'Ubah properti berhasil']);
    }

    public function destroy(Request $request, Property $property)
    {
        if ($property->owner_id != $request->session->id) {
            return response()->json(['message' => 'Properti tidak ditemukan'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $property->delete();

        return response()->json(['message' => 'Hapus properti berhasil'], Response::HTTP_NO_CONTENT);
    }
}
