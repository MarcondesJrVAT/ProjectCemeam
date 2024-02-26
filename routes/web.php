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

Route::controller(UserController::class)->prefix('usuarios')->name('users.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/cadastrar', 'create')->name('create');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(RoleController::class)->prefix('permissoes')->name('roles.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/criar-permissao', 'create')->name('create');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(NewsController::class)->prefix('noticias')->name('news.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/categorias', 'categoryNews')->name('category');
});

Route::controller(ContentController::class)->prefix('conteudos')->name('content.')->group(function () {
    Route::get('/categorias', 'contentCategory')->name('category');
    Route::get('/cursos', 'contentCourses')->name('courses');
    Route::get('/series', 'contentSeries')->name('series');
    Route::get('/componentes', 'contentComponents')->name('components');
    Route::get('/anos-letivos', 'contentSchoolYear')->name('schoolyear');
    Route::get('/aulas', 'contentClasses')->name('classes');

});

Route::controller(SiteController::class)->prefix('sites')->name('site.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(SlideController::class)->prefix('slides')->name('slide.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(AwardController::class)->prefix('premios')->name('award.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(BannerController::class)->prefix('banners')->name('banner.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/categorias', 'bannerCategory')->name('category');
});

Route::controller(CommentController::class)->prefix('comentarios')->name('comment.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/configuracoes', 'commentSetup')->name('setup');
});

require __DIR__ . '/auth.php';
