<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * The table is assigned
     *
     * @var array
     */
    protected $table = "weathers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'latitude',
        'longitude',
        'temperature',
        'weather',
        'icon',
        'type',
        'user_id',
    ];

    public function scopeWithSearch($query, $search)
    {
        if ($search) {
            $query->where('city', 'like', '%' . $search . '%')
                ->orWhere('temperature', 'like', '%' . $search . '%')
                ->orWhere('weather', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
