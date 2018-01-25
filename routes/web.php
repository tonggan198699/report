<?php

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


Route::get('/', 'ReportController@index');

Route::post('/save', 'ReportController@store');

Route::get('{report}/report', 'ReportController@show')->name('report.show');

Route::get('{report}/report/toPdf', 'ReportController@convertToPdf');
