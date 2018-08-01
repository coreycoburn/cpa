<?php

Route::get('/', 'MarketingController@welcome')->name('welcome');
Route::get('/about', 'MarketingController@about')->name('about');
Route::get('/services', 'MarketingController@services')->name('services');
Route::get('/accolades', 'MarketingController@accolades')->name('accolades');
Route::get('/employment', 'MarketingController@employment')->name('employment');

Route::get('/quote', 'QuoteController@index')->name('quote');
Route::post('/quote', 'QuoteController@store');

Route::get('/contract/sign', 'Contract\ContractController@index')
    ->name('sign-contract')
    ->middleware('quote');
Route::post('/contract/sign', 'Contract\ContractController@store');
Route::post('/contract/revise', 'Contract\ContractController@revise');
Route::post('/contract/decline', 'Contract\ContractController@decline');

Route::get('/contract/deposit', 'Contract\Deposit\ContractDepositController@index')->name('contract-deposit');
