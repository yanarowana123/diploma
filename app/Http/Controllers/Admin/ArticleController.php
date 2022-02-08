<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(): Factory|View|Application
    {
        $articles = Article::paginate(3);
        return view('admin.article.index', compact('articles'));
    }

    public function create(): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.article.create', compact('cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image'
        ]);
        $originName = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('image')->move(public_path('images'), $fileName);
        $attributes = $request->all();
        $attributes['image'] = '/images/' . $fileName;
        Article::create($attributes);
        return redirect()->route('admin.article.index');
    }

    public function edit(Article $article): Factory|View|Application
    {
        $cities = City::all();

        return view('admin.article.edit', compact('article', 'cities'));
    }

    public function update(Article $article, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image'
        ]);
        $attributes = $request->all();
        if ($request->image) {
            Storage::delete($article->image);
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('images'), $fileName);
            $attributes = $request->all();
            $attributes['image'] = '/images/' . $fileName;
        }

        $article->update($attributes);

        return redirect()->route('admin.article.index');
    }

    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function delete(Article $article): Factory|View|Application
    {
        $article->delete();
        return view('admin.article.index');
    }
}
