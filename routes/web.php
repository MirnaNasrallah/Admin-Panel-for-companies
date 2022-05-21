<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;

Auth::routes();



/*
Route::get('home', [HomeController::class, 'index'])->name('home'); */
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('admin/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');




// ------------------ CRUD ROUTES --------------------//
Route::get('auth/admin/dashboard',[CompaniesController::class, 'index'])->name('companies.index');
Route::get('dashboard/create',[CompaniesController::class, 'create'])->name('companies.create');
Route::post('dashboard',[CompaniesController::class, 'store'])->name('companies.store');
Route::get('dashboard/{id}',[CompaniesController::class, 'show'])->name('companies.show');
Route::get('dashboard/{id}/edit',[CompaniesController::class, 'edit'])->name('companies.edit');
Route::put('dashboard/{id}',[CompaniesController::class, 'update'])->name('companies.update');
Route::delete('dashboard/{id}',[CompaniesController::class, 'destroy'])->name('companies.destroy');


//----------------employee-----------------//
Route::get('auth/home',[HomeController::class, 'show'])->name('user.show');
Route::get('auth/home/{id}/edit',[HomeController::class, 'edit'])->name('user.edit');
Route::put('auth/home/{id}',[HomeController::class, 'update'])->name('user.update');
Route::get('register',[UserRegisterController::class, 'registerOpen'])->name('user.register.show');
Route::post('register',[UserRegisterController::class, 'register'])->name('user.register');
Route::get('login',[UserLoginController::class, 'loginOpen'])->name('user.login.show');
Route::post('login',[UserLoginController::class, 'login'])->name('user.login');

//---------------------------//

Route::post('dashboard/company/{id}',[CompaniesController::class, 'addUserToCompany'])->name('add.user.company');
Route::get('dashboard/company/{id}',[CompaniesController::class, 'viewUserFromCompany'])->name('view.user.company');
Route::delete('dashboard/company/{id}/{user_id}',[CompaniesController::class, 'deleteUserFromCompany'])->name('delete.user.company');




Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
