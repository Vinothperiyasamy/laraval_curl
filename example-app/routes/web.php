<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Employee;
use PhpParser\Node\Expr\Empty_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// group the route
// Route::group(['prefix'=>'admin'],function(){

//     Route::get('/test', function () {
//         return "hellow";
//     })->name('article');

//     Route::get('/test', function () {
//         return "hellow";
//     })->name('article');
// });

Route::get('/about-us', [HomeController::class, 'aboutUs']);

Route::get('/test', function () {
    return "hellow";
})->name('article');


// employee 

// Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
// Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
// Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employee.store');
// Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
// Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
// Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
// Route::get('/employees//{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
// Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');


// resource

Route::resource('employee', EmployeeController::class);
