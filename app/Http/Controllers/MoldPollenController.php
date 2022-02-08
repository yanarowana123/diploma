<?php

namespace App\Http\Controllers;

use App\Models\Mold;

class MoldPollenController extends Controller
{
    public function __invoke(Mold $pollen)
    {
        return view('pollen', compact('pollen'));
    }
}
