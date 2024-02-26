<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () {
    return Inertia::render('Dashboard',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UserController::class)->prefix('usuarios')->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::get('/cadastrar', 'create')->name('users.create');
    Route::delete('/{id}', 'destroy')->name('users.destroy');
});

Route::controller(RoleController::class)->prefix('permissoes')->group(function () {
    Route::get('/', 'index')->name('roles.index');
    Route::get('/criar-permissao', 'create')->name('roles.create');
    Route::delete('/{id}', 'destroy')->name('roles.destroy');
});

Route::controller(NewsController::class)->prefix('noticias')->group(function () {
    Route::get('/', 'index')->name('news.index');
    Route::get('/categorias', 'categoryNews')->name('news.category');
});

Route::controller(ContentController::class)->prefix('conteudos')->group(function () {
    Route::get('/categorias', 'contentCategory')->name('content.category');
    Route::get('/cursos', 'contentCourses')->name('content.courses');
    Route::get('/series', 'contentSeries')->name('content.series');
    Route::get('/componentes', 'contentComponents')->name('content.components');
    Route::get('/anos-letivos', 'contentSchoolYear')->name('content.schoolyear');
    Route::get('/aulas', 'contentClasses')->name('content.classes');

});

Route::controller(SiteController::class)->prefix('sites')->group(function () {
    Route::get('/', 'index')->name('site.index');
});

Route::controller(SlideController::class)->prefix('slides')->group(function () {
    Route::get('/', 'index')->name('slide.index');
});

Route::controller(AwardController::class)->prefix('premios')->group(function () {
    Route::get('/', 'index')->name('award.index');
});

Route::controller(BannerController::class)->prefix('banners')->group(function () {
    Route::get('/', 'index')->name('banner.index');
    Route::get('/categorias', 'bannerCategory')->name('banner.category');
});

Route::controller(CommentController::class)->prefix('comentarios')->group(function () {
    Route::get('/', 'index')->name('comment.index');
    Route::get('/configuracoes', 'commentSetup')->name('comment.setup');
});

require __DIR__ . '/auth.php';
