<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $accessToken = Session::get('accessToken');
        $url = config('services.main_api.url') . "/api/property";
        $resp = Http::withToken($accessToken)->get($url);
        if ($resp->getStatusCode() != Response::HTTP_OK) {
            return redirect()->route('login')->with('message-error', 'Gagal mendapatkan data');
        }

        $properties = json_decode($resp->body(), true)['data'];
        return view('property.index', compact('properties'));
    }

    public function store(PropertyRequest $request)
    {
        $accessToken = Session::get('accessToken');
        $url = config('services.main_api.url') . "/api/property";
        $resp = Http::withToken($accessToken)->post($url, $request->validated());
        if ($resp->getStatusCode() != Response::HTTP_CREATED) {
            return redirect()->route('property-dashboard.index')->with('message-error', 'Tambah Properti Gagal');
        }

        return redirect()->route('property-dashboard.index')->with('message', 'Tambah Properti Berhasil');
    }

    public function update(PropertyRequest $request)
    {
        $accessToken = Session::get('accessToken');
        $url = config('services.main_api.url') . "/api/property/{$request->id}";
        $resp = Http::withToken($accessToken)->patch($url, $request->validated());
        if ($resp->getStatusCode() != Response::HTTP_OK) {
            return redirect()->route('property-dashboard.index')->with('message-error', 'Ubah Properti Gagal');
        }

        return redirect()->route('property-dashboard.index')->with('message', 'Ubah Properti Berhasil');
    }

    public function destroy($propertyId)
    {
        $accessToken = Session::get('accessToken');
        $url = config('services.main_api.url') . "/api/property/{$propertyId}";
        $resp = Http::withToken($accessToken)->delete($url);
        if ($resp->getStatusCode() != Response::HTTP_NO_CONTENT) {
            return redirect()->route('property-dashboard.index')->with('message-error', 'Hapus Properti Gagal');
        }

        return redirect()->route('property-dashboard.index')->with('message', 'Hapus Properti Berhasil');
    }

}
