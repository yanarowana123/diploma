<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    public const OPEN_WEATHER = 0;
    public const AKKU = 1;
    public const WEATHER_API = 2;

    protected $table = 'weather';

    protected $guarded = ['id'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
