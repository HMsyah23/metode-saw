<?php

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

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['middleware' => 'auth'], function () {
 
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::resource('kriteria','KriteriaController');
    Route::resource('subkriteria','SubKriteriaController');
    Route::resource('siswa','SiswaController');
    Route::post('siswa/update/{id}','SiswaController@update')->name('siswa.update');
    Route::post('siswa/delete/{id}', 'SiswaController@delete')->name('siswa.destroy');
    Route::get('ranking','RankingController@index')->name('ranking.index');
    Route::get('ranking/saw','RankingController@saw')->name('ranking.saw');

    Route::get('user', 'HomeController@user')->name('user');
    Route::get('user/{id}', 'HomeController@show')->name('user.show');
    Route::post('user/save', 'HomeController@save')->name('user.save');
    Route::post('user/delete/{id}', 'HomeController@delete')->name('user.destroy');
    Route::post('user/update/{id}', 'HomeController@update')->name('user.update');

        // Laporan
    Route::get('/laporan/ranking','LaporanController@laporanRanking')->name('laporan.ranking');
    Route::get('/laporan/siswa/{id}','LaporanController@laporanSiswa')->name('laporan.siswa');
});
