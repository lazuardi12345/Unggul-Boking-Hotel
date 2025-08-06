<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin View
Route::get('/admin/dashboard', function () {
    return view('admin.admin_dashboard'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-dashboard');

Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin-login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin-login.post');

Route::get('/register/admin', [RegisterController::class, 'showAdminForm'])->name('admin-register');
Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name(name:'admin-register.store');

Route::get('admin/orders', function () {
    return view('admin.orders'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-orders');

Route::get('/admin/properties', [HotelController::class, 'getAllData'])->name('admin-properties');;

Route::get('admin/agents', function () {
    return view('admin.admin_agents'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-agents');

Route::get('admin/location', function () {
    return view('admin.location'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-location');

Route::get('admin/website-setting', function () {
    return view('admin.website_setting'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-website-setting');

Route::get('/admin/sidebar', function () {
    return view('admin.sidebar.sidebar-main'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-sidebar');

Route::get('/admin/website-setting', function () {
    return view('admin.website_setting'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-website-setting');



// Customer View
Route::get('/register/customer', [RegisterController::class, 'showCustomerForm'])->name('customer-register');
Route::post('/register/customer', [RegisterController::class, 'registerCustomer']);

Route::get('/customer/login', [LoginController::class, 'showCustomerLoginForm'])->name('customer-login');
Route::post('/customer/login', [LoginController::class, 'login'])->name('customer-login.post');


// Agent View
Route::get('/agent/dashboard', function () {
    return view('agents.agent_dashboard'); // pastikan ada file resources/views/profile.blade.php
})->name('agent-dashboard');
Route::get('admin/agent/dashboard/data', [HotelController::class, 'getAllData']);
Route::resource('admin/agent/dashboard', HotelController::class);


Route::get('/register/agent', [RegisterController::class, 'showAgentForm'])->name('agent-register');
Route::post('/register/agent', [RegisterController::class, 'registerAgent']);

Route::get('/agent/login', [LoginController::class, 'showAgentLoginForm'])->name('agent-login');
Route::post('/agent/login', [LoginController::class, 'login'])->name('agent-login.post');


// Main View
Route::get('/', function () {
    return view('main.index');
})->name('index');

// Main View
Route::get('/sidebar', function () {
    return view('layouts.sidebar');
})->name('sidebar');

Route::get('/forgot-password', function () {
    return view('password.forget_password');
})->name('password.request');

Route::get('/profile', function () {
    return view('main.profile'); // pastikan ada file resources/views/profile.blade.php
})->name('profile');

Route::get('/cart', function () {
    return view('main.cart'); // pastikan ada file resources/views/profile.blade.php
})->name('cart');

Route::get('/contact-admin', function () {
    return view('main.contact_admin'); // pastikan ada file resources/views/profile.blade.php
})->name('contact-admin');

Route::get('/setting', function () {
    return view('settings.settings'); // pastikan ada file resources/views/profile.blade.php
})->name('setting');

Route::get('/account-security', function () {
    return view('settings.account_security'); // pastikan ada file resources/views/profile.blade.php
})->name('account-security');

Route::get('/language-setting', function () {
    return view('settings.language_settings'); // pastikan ada file resources/views/profile.blade.php
})->name('language-setting');

Route::get('/ganti-password', function () {
    return view('settings.ganti_password'); // pastikan ada file resources/views/profile.blade.php
})->name('ganti-password');

Route::get('/layanan', function () {
    return view('main.layanan'); // pastikan ada file resources/views/profile.blade.php
})->name('layanan');

Route::get('/properties', function () {
    return view('main.properties'); // pastikan ada file resources/views/profile.blade.php
})->name('properties');

Route::get('admin/location', function () {
    return view('admin.location'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-location');

Route::get('admin/website-setting', function () {
    return view('admin.website_setting'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-website-setting');

Route::get('admin/orders', function () {
    return view('admin.orders'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-orders');

Route::get('admin/agents', function () {
    return view('admin.admin_agents'); // pastikan ada file resources/views/profile.blade.php
})->name('admin-agents');

Route::get('/agents', function () {
    return view('main.agents'); // pastikan ada file resources/views/profile.blade.php
})->name('agents');

Route::get('/user-selection', function () {
    return view('main.user_selection'); // pastikan ada file resources/views/profile.blade.php
})->name('user-selection');

Route::get('/booking-properties', function () {
    return view('booking.booking_properties'); // pastikan ada file resources/views/profile.blade.php
})->name('booking-properties');

Route::get('/login', function () {
    return view('auth.login'); // pastikan ada file resources/views/profile.blade.php
})->name('login');








// Route::get('/register/agent', [RegisterController::class, 'showAgentForm'])->name('agent-register');
// Route::post('/register/agent', [RegisterController::class, 'registerAgent']);


