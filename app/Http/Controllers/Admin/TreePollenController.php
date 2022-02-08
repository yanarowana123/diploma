<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use App\Models\TreePollen;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreePollenController extends Controller
{
    public function index(): Factory|View|Application
    {
        $articles = TreePollen::paginate(10);
        return view('admin.tree_pollen.index', compact('articles'));
    }

    public function create(): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.tree_pollen.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        TreePollen::create($request->all());
        return redirect()->route('admin.tree_pollen.index');
    }

    public function edit(TreePollen $treePollen): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.tree_pollen.edit', compact('treePollen', 'cities'));
    }

    public function update(TreePollen $treePollen, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $treePollen->update($request->all());

        return redirect()->route('admin.tree_pollen.index');
    }

    public function delete(TreePollen $treePollen): Factory|View|Application
    {
        $treePollen->delete();
        return view('admin.tree_pollen.index');
    }
}
