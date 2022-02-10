<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function treePollen()
    {
        return $this->hasMany(TreePollen::class);
    }

    public function grassPollen()
    {
        return $this->hasMany(GrassPollen::class);
    }

    public function ragweedPollen()
    {
        return $this->hasMany(RagweedPollen::class);
    }

    public function mold()
    {
        return $this->hasMany(Mold::class);
    }

    public function dust()
    {
        return $this->hasMany(DustDanger::class);
    }
}
