<?php

namespace App\Http\Controllers;

use App\Models\TreePollen;

class TreePollenController extends Controller
{
    public function __invoke(TreePollen $pollen)
    {
        return view('pollen', compact('pollen'));
    }
}
