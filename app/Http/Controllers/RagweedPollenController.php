<?php

namespace App\Http\Controllers;

use App\Models\RagweedPollen;

class RagweedPollenController extends Controller
{
    public function __invoke(RagweedPollen $pollen)
    {
        return view('pollen', compact('pollen'));
    }
}
