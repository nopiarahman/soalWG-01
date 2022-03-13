<?php

use Illuminate\Support\Facades\Route;
use App\Berita;
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

Route::get('/', function () {
    $berita = Berita::paginate(5);
    return view('welcome',compact('berita'));
});

Auth::routes();

Route::get('/home', 'HomeController@profil')->name('home');
Route::group(['middleware' => ['role:admin|editor']], function () {
    /* Berita */
    Route::get('/berita', 'BeritaController@index')->name('berita');
    Route::post('/berita', 'BeritaController@store')->name('beritaSimpan');
    Route::patch('/berita/{id}', 'BeritaController@update');
    Route::delete('/berita/{id}', 'BeritaController@destroy');
    
    /* Kategori */
    Route::get('/kategori', 'KategoriController@index')->name('kategori');
    Route::post('/kategori', 'KategoriController@store')->name('kategoriSimpan');
    Route::patch('/kategori/{id}', 'KategoriController@update');
    Route::delete('/kategori/{id}', 'KategoriController@destroy');
    
    /* Profil */
    Route::get('/profil', 'HomeController@profil')->name('profil');

    /* user */
    Route::get('/user', 'HomeController@user')->name('user');

});