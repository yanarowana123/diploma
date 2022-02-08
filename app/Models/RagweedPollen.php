<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RagweedPollen extends Model
{
    use HasFactory;

    protected $table = 'ragweed_pollen';

    protected $guarded = ['id'];
}
