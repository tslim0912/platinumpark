<?php

namespace App\Mixins;

use Closure;
use Illuminate\Support\Facades\Route;

class RouteMixins
{
    public function authentication(): Closure
    {
        return function (array $options = [], $name = ".") {
            Route::namespace('Auth')->group(function () use ($options, $name) {
                Route::get('login', 'LoginController@showLoginForm')->name($name . 'login');
                Route::post('login', 'LoginController@login');
                Route::post('logout', 'LoginController@logout')->name($name . 'logout');

                if ($options['register'] ?? true) {
                    Route::get('register', 'RegisterController@showRegistrationForm')->name($name . 'register');
                    Route::post('register', 'RegisterController@register');
                }

                // Password Reset Routes...
                if ($options['reset'] ?? true) {
                    Route::name(".password")->group(function () use ($name) {
                        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name($name . 'request');
                        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name($name . 'email');
                        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name($name . 'reset');
                        Route::post('password/reset', 'ResetPasswordController@reset')->name($name . 'update');
                    });
                }

                // Email Verification Routes...
                if ($options['verify'] ?? false) {
                    Route::name(".verification")->group(function () use ($name) {
                        Route::get('email/verify', 'VerificationController@show')->name($name . 'notice');
                        Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name($name . 'verify');
                        Route::post('email/resend', 'VerificationController@resend')->name($name . 'resend');
                    });
                }
            });
        };
    }

    public function resourceNaming(): Closure
    {
        return function ($prefix = "", $misc = null) {
            $result = [
                "names" => [
                    "index" => $prefix . ".index",
                    "show" => $prefix . ".show",
                    "create" => $prefix . ".create",
                    "store" => $prefix . ".store",
                    "edit" => $prefix . ".edit",
                    "update" => $prefix . ".update",
                    "destroy" => $prefix . ".destroy"
                ]
            ];
            
            if (!is_null($misc) && is_array($misc)) {
                $result = array_merge($result, $misc);
            }

            return $result;
        };
    }
}
