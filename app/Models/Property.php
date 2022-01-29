<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, HelperTrait, SoftDeletes;

    protected $fillable = [
        'owner_id',
        'name',
        'location',
        'price',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function scopeSearch($query, $request)
    {
        $query->when(in_array($request->search_by, ['name', 'location', 'price']), function ($query) use ($request) {
            $query->where($request->search_by, 'LIKE', "%{$request->search_query}%");
        });

        return $query;
    }

    public function scopeOrder($query, $request)
    {
        $query->when(in_array($request->order_by, ['price']), function ($query) use ($request) {
            $query->orderBy($request->order_by, $this->getValidOrderDirection($request->order_direction));
        });

        return $query;
    }
}
