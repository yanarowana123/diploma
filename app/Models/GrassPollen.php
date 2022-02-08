<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrassPollen extends Model
{
    use HasFactory;

    protected $table = 'grass_pollen';

    protected $guarded = ['id'];
}
