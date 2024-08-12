<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderuserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;



Route::controller(LoginController::class)->group(function(){
    //register
    Route::get('/register','register')->name('register');
    Route::post('/register/post','registerPost')->name('register.Post');
    //login
    Route::get('/','login')->name('login');
    Route::post('/login/post','loginPost')->name('login.Post');
    //logout
    Route::get('/logout',function(){
        session()->forget('cart');
        return redirect()->route('login');
    });
});
Route::group(['middleware' => 'is_admin'],function(){
    Route::controller(OrderController::class)->group(function (){
        //admin/main/index
        Route::get('/admin/index','orderShow')->name('order');
        Route::post('/admin/index/addTocart','addTocart')->name('addTocart');
        Route::post('/admin/index/remove','remove')->name('index.remove');
        Route::post('/admin/index/store','store')->name('index.store');

    });
    Route::controller(ServiceController::class)->group(function(){
        //admin/servicee/service
        Route::get('/admin/service','serviceShow')->name('service');
        Route::post('/admin/service/add','serviceAdd')->name('service.add');
        Route::post('/admin/service/edit','serviceEdit')->name('service.edit');
        Route::post('/admin/service/delete','serviceDelete')->name('service.delete');
    });
    Route::controller(EmployeeController::class)->group(function(){
        //admin/employee/employee
        Route::get('/admin/employee','empShow')->name('employee');
        Route::post('/admin/employee/add','empadd')->name('employee.add');
        Route::post('/admin/employee/edit','empedit')->name('employee.edit');
        Route::post('/admin/employee/editpass','emppass')->name('employee.editpass');
    });
    Route::controller(PaymentController::class)->group(function(){
        //admin/main/payment
        Route::get('/admin/payment','show_cleaning')->name('payment');
        //admin/main/wait
        Route::get('/admin/wait','show_waitclean')->name('payment.wait');
        //admin/main/cleaned
        Route::get('/admin/cleaned','show_cleaned')->name('payment.cleaned');

        //admin/main/payment/update
        Route::get('/admin/wait/{id}','updating')->name('payment.call');
        Route::post('/admin/payment','updated')->name('payment.reciep');
    });
    Route::controller(ReportController::class)->group(function(){
        Route::get('/admin/report_service','report_data')->name('report_service');
        Route::get('/admin/generator_PDF','pdf_generator_get')->name('PDF_generator');
        Route::get('/admin/report_search','search')->name('rp_search');
    });

});

//user/index
Route::controller(OrderuserController::class)->group(function (){
    //user/main/index
    Route::get('/user/index','orderuserShow')->name('user');
    Route::post('/user/index/addTocart','addTocart')->name('user.addTocart');
    Route::post('/user/index/remove','remove')->name('user.remove');
    Route::post('/user/index/store','store')->name('user.store');

});

Route::controller(PaymentController::class)->group(function(){
    //user/main/payment
    Route::get('/user/payment','show_cleaning1')->name('payment1');
    //user/main/wait
    Route::get('/user/wait','show_waitclean1')->name('payment.wait1');
    //user/main/cleaned
    Route::get('/user/cleaned','show_cleaned1')->name('payment.cleaned1');
    
    Route::get('/user/wait/{id}','updating')->name('payment.call1');
    Route::post('/user/payment','updated')->name('payment.reciep1');
});


    