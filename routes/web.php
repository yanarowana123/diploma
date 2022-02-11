<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DustController;
use App\Http\Controllers\Admin\GrassPollenController;
use App\Http\Controllers\Admin\MoldController;
use App\Http\Controllers\Admin\RagweedPollenController;
use App\Http\Controllers\Admin\TreePollenController;
use App\Http\Controllers\Admin\WeatherController;
use App\Http\Controllers\DustPollenController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MoldPollenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/admin/weather', WeatherController::class)->name('admin.weather');


    Route::get('/admin/city/create', [CityController::class, 'create'])->name('admin.city.create');
    Route::post('/admin/city', [CityController::class, 'store'])->name('admin.city.store');


    Route::get('/admin/article', [ArticleController::class, 'index'])->name('admin.article.index');
    Route::get('/admin/article/create', [ArticleController::class, 'create'])->name('admin.article.create');
    Route::post('/admin/article/store', [ArticleController::class, 'store'])->name('admin.article.store');
    Route::get('/admin/article/{article}/edit', [ArticleController::class, 'edit'])->name('admin.article.edit');
    Route::put('/admin/article/{article}/update', [ArticleController::class, 'update'])->name('admin.article.update');
    Route::get('/admin/article/{article}/delete', [ArticleController::class, 'delete'])->name('admin.article.delete');


    Route::get('/admin/tree_pollen', [TreePollenController::class, 'index'])->name('admin.tree_pollen.index');
    Route::get('/admin/tree_pollen/create', [TreePollenController::class, 'create'])->name('admin.tree_pollen.create');
    Route::post('/admin/tree_pollen/store', [TreePollenController::class, 'store'])->name('admin.tree_pollen.store');
    Route::get('/admin/tree_pollen/{treePollen}/edit', [TreePollenController::class, 'edit'])->name('admin.tree_pollen.edit');
    Route::put('/admin/tree_pollen/{treePollen}/update', [TreePollenController::class, 'update'])->name('admin.tree_pollen.update');
    Route::get('/admin/tree_pollen/{treePollen}/delete', [TreePollenController::class, 'delete'])->name('admin.tree_pollen.delete');

    Route::get('/admin/grass_pollen', [GrassPollenController::class, 'index'])->name('admin.grass_pollen.index');
    Route::get('/admin/grass_pollen/create', [GrassPollenController::class, 'create'])->name('admin.grass_pollen.create');
    Route::post('/admin/grass_pollen/store', [GrassPollenController::class, 'store'])->name('admin.grass_pollen.store');
    Route::get('/admin/grass_pollen/{treePollen}/edit', [GrassPollenController::class, 'edit'])->name('admin.grass_pollen.edit');
    Route::put('/admin/grass_pollen/{treePollen}/update', [GrassPollenController::class, 'update'])->name('admin.grass_pollen.update');
    Route::get('/admin/grass_pollen/{treePollen}/delete', [GrassPollenController::class, 'delete'])->name('admin.grass_pollen.delete');

    Route::get('/admin/ragweed', [RagweedPollenController::class, 'index'])->name('admin.ragweed.index');
    Route::get('/admin/ragweed/create', [RagweedPollenController::class, 'create'])->name('admin.ragweed.create');
    Route::post('/admin/ragweed/store', [RagweedPollenController::class, 'store'])->name('admin.ragweed.store');
    Route::get('/admin/ragweed/{treePollen}/edit', [RagweedPollenController::class, 'edit'])->name('admin.ragweed.edit');
    Route::put('/admin/ragweed/{treePollen}/update', [RagweedPollenController::class, 'update'])->name('admin.ragweed.update');
    Route::get('/admin/ragweed/{treePollen}/delete', [RagweedPollenController::class, 'delete'])->name('admin.ragweed.delete');

    Route::get('/admin/dust', [DustController::class, 'index'])->name('admin.dust.index');
    Route::get('/admin/dust/create', [DustController::class, 'create'])->name('admin.dust.create');
    Route::post('/admin/dust/store', [DustController::class, 'store'])->name('admin.dust.store');
    Route::get('/admin/dust/{treePollen}/edit', [DustController::class, 'edit'])->name('admin.dust.edit');
    Route::put('/admin/dust/{treePollen}/update', [DustController::class, 'update'])->name('admin.dust.update');
    Route::get('/admin/dust/{treePollen}/delete', [DustController::class, 'delete'])->name('admin.dust.delete');

    Route::get('/admin/mold', [MoldController::class, 'index'])->name('admin.mold.index');
    Route::get('/admin/mold/create', [MoldController::class, 'create'])->name('admin.mold.create');
    Route::post('/admin/mold/store', [MoldController::class, 'store'])->name('admin.mold.store');
    Route::get('/admin/mold/{treePollen}/edit', [MoldController::class, 'edit'])->name('admin.mold.edit');
    Route::put('/admin/mold/{treePollen}/update', [MoldController::class, 'update'])->name('admin.mold.update');
    Route::get('/admin/mold/{treePollen}/delete', [MoldController::class, 'delete'])->name('admin.mold.delete');

    Route::post('/admin/upload', [ArticleController::class, 'upload']);
});

Route::get('/', [MapController::class, 'index'])->name('home');
Route::get('weather', [MapController::class, 'getWeatherInfo']);
Route::get('article', [\App\Http\Controllers\ArticleController::class, 'articlesPage'])->name('article.page');
Route::get('{city}/article', [\App\Http\Controllers\ArticleController::class, 'articlesPage'])->name('article.city');
Route::get('article/{article}', [\App\Http\Controllers\ArticleController::class, 'view'])->name('article.view');

Route::get('tree/{pollen}', \App\Http\Controllers\TreePollenController::class)->name('tree.view');
Route::get('grass/{pollen}', \App\Http\Controllers\GrassPollenController::class)->name('grass.view');
Route::get('ragweed/{pollen}', \App\Http\Controllers\RagweedPollenController::class)->name('ragweed.view');
Route::get('dust/{pollen}', DustPollenController::class)->name('dust.view');
Route::get('mold/{pollen}', MoldPollenController::class)->name('mold.view');


//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
