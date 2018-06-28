<?php

Route::prefix('v1')->namespace('Api\V1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        // Notes
        Route::apiResource('notes', 'NoteController');

        // Users
        Route::resource('users', 'UserController', ['only' => 'update']);
    });

    // Auth
    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AuthController@register');

    // Notes
    Route::apiResource('notes', 'NoteController', ['only' => ['show']]);

    // Users
    Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
});
