<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', 'AuthController@indexRegister')->name('register');
Route::post('/register', 'AuthController@checkRegister')->name('checkRegister');
Route::get('/login', 'AuthController@indexLogin')->name('login');
Route::post('/login', 'AuthController@checkLogin')->name('checkLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'checkrole:walikelas']], function () {
    Route::get('/walikelas', 'WalikelasController@index');
    Route::get('/walikelas/user/tambah', 'WalikelasController@TambahUser');
    Route::post('/walikelas/user/tambah/proses', 'WalikelasController@AddUser')->name('addUser');
    Route::get('/walikelas/profile','WalikelasController@profile');
    Route::get('/walikelas/transaksi', 'TransaksiController@walikelasTransaksi');
});

Route::group(['middleware' => ['auth', 'checkrole:pengurus']], function () {
    Route::get('/pengurus', 'PengurusController@index');
    Route::get('/pengurus/transaksi', 'TransaksiController@pengurusTransaksi');
    Route::get('/pengurus/transaksi/pemasukan', 'PengurusController@pemasukan');
    Route::post('/pengurus/transaksi/pemasukan/proses', 'PengurusController@prosespemasukan')->name('addpemasukan');
    Route::get('/pengurus/transaksi/pengeluaran', 'PengurusController@pengeluaran');
    Route::post('/pengurus/transaksi/pengeluaran/proses', 'PengurusController@prosespengeluaran')->name('addpengeluaran');
    Route::get('/pengurus/profile','PengurusController@profile');
});

Route::group(['middleware' => ['auth', 'checkrole:anggota']], function () {
    Route::get('/anggota', 'AnggotaController@index');
    Route::get('/anggota/transaksi', 'TransaksiController@anggotaTransaksi');
    Route::get('/anggota/profile','AnggotaController@profile');
});

