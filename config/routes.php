<?php

use Libs\System\File;
use Libs\Web\Route;


// Route::get('hello', function(){
//     return "Hello";
// });

// Route::get('hai', new File('be/hai'));
// Route::get('oke', new File('be/oke'));
// Route::get('test', [Be\Auth\LoginController::class, 'index']);
    
Route::get('/', function(){
    return "Root Site";
});

Route::get('login', new File('fe/auth/login', true));
Route::post('login', [Be\Auth\LoginController::class, 'login']);

Route::beforeEnter('sessionRequired')->get('dashboard', new File('fe/admin/dashboard', true));
Route::beforeEnter('sessionRequired')->get('reports', new File('fe/admin/reports', true));
Route::beforeEnter('sessionRequired')->get('users', new File('fe/admin/users', true));
Route::beforeEnter('sessionRequired')->get('user', [Be\UserController::class, 'show']);
Route::beforeEnter('sessionRequired')->post('users', [Be\UserController::class, 'store']);
Route::beforeEnter('sessionRequired')->put('users', [Be\UserController::class, 'update']);
Route::beforeEnter('sessionRequired')->delete('users', [Be\UserController::class, 'delete']);
Route::beforeEnter('sessionRequired')->get('logout', [Be\Auth\LoginController::class, 'logout']);