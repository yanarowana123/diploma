<?php

namespace App\Http\Controllers;

use App\Models\DustDanger;
use App\Models\TreePollen;

class DustPollenController extends Controller
{
    public function __invoke(DustDanger $pollen)
    {
        return view('pollen', compact('pollen'));
    }
}
