<?php

Route::get('/', 'MarketingController@welcome')->name('welcome');
Route::get('/about', 'MarketingController@about')->name('about');
Route::get('/services', 'MarketingController@services')->name('services');
Route::get('/accolades', 'MarketingController@accolades')->name('accolades');
Route::get('/employment', 'MarketingController@employment')->name('employment');

Route::get('/quote', 'Quote\QuoteController@index')->name('quote');
Route::post('/quote', 'Quote\QuoteController@store');

Route::get('/contract/sign', 'ContractController@index')->name('sign-contract');
Route::post('/contract/sign', 'ContractController@store');
Route::post('/contract/revise', 'ContractController@revise');
Route::post('/contract/decline', 'ContractController@decline');

Route::get('/contract/deposit', 'ContractDepositController@index')->name('contract-deposit');
