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
    header('location: /dashboard');
    die;
});

Route::get('login', new File('fe/auth/login', true));
Route::post('login', [Be\Auth\LoginController::class, 'login']);

// Route::get('add-admin', function(){
//     \Libs\Database\DB::table('users')->insert([
//         'code' => 'admin',
//         'name' => 'admin',
//         'username' => 'admin',
//         'password' => 'admin',
//         'level' => 'admin'
//     ]);
// });

Route::beforeEnter('sessionRequired')->get('dashboard', new File('fe/admin/dashboard', true));
Route::beforeEnter('sessionRequired')->get('reports', new File('fe/admin/reports', true));
Route::beforeEnter('sessionRequired')->get('reports/download', new File('be/report-download', true));
Route::beforeEnter('sessionRequired')->get('report-data', new File('be/report-data', true));
Route::beforeEnter('sessionRequired')->get('report-data-statistic', new File('be/report-data-statistic', true));
Route::beforeEnter('sessionRequired')->get('users', new File('fe/admin/users', true));
Route::beforeEnter('sessionRequired')->get('user', [Be\UserController::class, 'show']);
Route::beforeEnter('sessionRequired')->post('users', [Be\UserController::class, 'store']);
Route::beforeEnter('sessionRequired')->put('users', [Be\UserController::class, 'update']);
Route::beforeEnter('sessionRequired')->delete('users', [Be\UserController::class, 'delete']);
Route::beforeEnter('sessionRequired')->get('logout', [Be\Auth\LoginController::class, 'logout']);