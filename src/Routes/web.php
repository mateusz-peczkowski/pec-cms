<?php

Route::get('/', function () {
    return redirect()->route('pec-cms.login');
});

Route::get('/login', 'Auth\LoginController@index')->name('pec-cms.login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout')->name('pec-cms.logout');

Route::get('/password-reset', 'Auth\PasswordController@index')->name('pec-cms.password.reset');
Route::post('/password-reset', 'Auth\PasswordController@reset');

Route::get('/password-reset/sent', 'Auth\PasswordController@confirmation')->name('pec-cms.password.sent');
Route::get('/password-reset/{token}', 'Auth\PasswordController@password')->name('pec-cms.password.token');
Route::post('/password-reset/{token}', 'Auth\PasswordController@change');

Route::group(['middleware' => 'pec-cms.auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('pec-cms.dashboard');
});
