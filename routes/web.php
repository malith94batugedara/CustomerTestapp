<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/',[CustomerController::class,'index'])->name('welcome');

Route::post('/savecustomer',[CustomerController::class,'saveCustomer'])->name('customer.save');

Route::get('/viewallcustomers',[CustomerController::class,'viewAllCustomer'])->name('customer.all');

Route::get('/editcustomer/{customer_id}',[CustomerController::class,'editCustomer'])->name('customer.edit');

Route::post('/updatecustomer/{customer_id}',[CustomerController::class,'updateCustomer'])->name('customer.update');

Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('customer.delete');

Route::get('web/{id}/get',[CustomerController::class,'getDistrict'])->name('customer.getdistrict');

Route::get('web/{id}/gettown',[CustomerController::class,'getTown'])->name('customer.gettown');


