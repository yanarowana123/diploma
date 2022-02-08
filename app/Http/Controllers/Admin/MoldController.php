<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use App\Models\moldDanger;
use App\Models\Mold;
use App\Models\RagweedPollen;
use App\Models\TreePollen;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoldController extends Controller
{
    public function index(): Factory|View|Application
    {
        $articles = Mold::paginate(10);
        return view('admin.mold.index', compact('articles'));
    }

    public function create(): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.mold.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Mold::create($request->all());
        return redirect()->route('admin.mold.index');
    }

    public function edit(Mold $treePollen): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.mold.edit', compact('treePollen', 'cities'));
    }

    public function update(Mold $treePollen, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $treePollen->update($request->all());

        return redirect()->route('admin.mold.index');
    }

    public function delete(Mold $treePollen): Factory|View|Application
    {
        $treePollen->delete();
        return view('admin.mold.index');
    }
}
