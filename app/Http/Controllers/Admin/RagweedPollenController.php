<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use App\Models\RagweedPollen;
use App\Models\TreePollen;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RagweedPollenController extends Controller
{
    public function index(): Factory|View|Application
    {
        $articles = RagweedPollen::paginate(10);
        return view('admin.ragweed.index', compact('articles'));
    }

    public function create(): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.ragweed.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        RagweedPollen::create($request->all());
        return redirect()->route('admin.ragweed.index');
    }

    public function edit(RagweedPollen $treePollen): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.ragweed.edit', compact('treePollen', 'cities'));
    }

    public function update(RagweedPollen $treePollen, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $treePollen->update($request->all());

        return redirect()->route('admin.ragweed.index');
    }

    public function delete(RagweedPollen $treePollen): Factory|View|Application
    {
        $treePollen->delete();
        return view('admin.ragweed.index');
    }
}
