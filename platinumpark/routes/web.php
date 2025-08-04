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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name("home");
Route::get('business', 'HomeController@business')->name("business");
Route::get('conveniences', 'HomeController@conveniences')->name("conveniences");
Route::get('about-us', 'HomeController@aboutUs')->name("about-us");
Route::get('whats-on', 'HomeController@whatsOn')->name("whats-on");



Route::get('contact', 'HomeController@contact')->name("contact");

Route::get('lifestyle', 'HomeController@lifestyle')->name("lifestyle");
Route::get('lifestyle/{slug}', 'HomeController@lifestyleDetail')->name("lifestyle-detail");

Route::get('search', 'HomeController@lifestyle_search')->name('lifestyle.search');


Route::get('enquiry', 'HomeController@enquiry')->name("enquiry");
Route::post('enquiry', "HomeController@storeEnquiry")->name('enquiry.store');

Route::get('terms-and-conditions', 'HomeController@termsConditions')->name("terms-conditions");
Route::get('privacy-policy', 'HomeController@privacyPolicy')->name("privacy-policy");



