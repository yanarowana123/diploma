<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DustDanger extends Model
{
    use HasFactory;

    protected $table = 'dust_and_danger';

    protected $guarded = ['id'];
}
