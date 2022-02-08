<?php

namespace App\Http\Controllers;

use App\Models\GrassPollen;
use App\Models\TreePollen;

class GrassPollenController extends Controller
{
    public function __invoke(GrassPollen $pollen)
    {
        return view('pollen', compact('pollen'));
    }
}
