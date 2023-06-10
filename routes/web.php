<?php


use Carbon\Carbon;
use App\Models\Loan;
use App\Jobs\SendEmailJob;
use App\Models\Instalment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeaheadController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\IncomeChartController;
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



//
//sdfsfasdf
//sdfasf
//sadf
//

Route::middleware('auth')->group(function () {

    Route:: get('/loan', [LoanController::class, 'index'])->name('loan.index');
    Route:: get('/loan/{loan}', [LoanController::class, 'show'])->name('loan.show');
    Route:: get('/loan/{loan}/edit', [LoanController::class, 'edit'])->name('loan.edit');
    Route:: put('/loan/{loan}', [LoanController::class, 'update'])->name('loan.update')->can('update', 'loan');
    Route:: get('/loan/{loan}/delete', [LoanController::class, 'showdelete'])->name('loan.delete');
    Route:: delete('/loan/{loan}/delete', [LoanController::class, 'destroy'])->name('loan.destroy');
    Route:: get('/loan/{user}/create', [LoanController::class, 'create'])->name('loan.create');
    Route:: POST('/loan', [LoanController::class, 'store'])->name('loan.store');

    // Route::resource('loan', LoanController::class);

    Route::get('/instalment/{instalment}/edit', 'App\Http\Controllers\InstalmentController@edit')->name('instalment.edit');
    Route::put('/instalment/{instalment}', 'App\Http\Controllers\InstalmentController@update')->name('instalment.update');
    Route::get('/instalment/{loan}', 'App\Http\Controllers\InstalmentController@show')->name('instalment.show');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{user:name}/report', [LoanController::class, 'report'])->name('loan.report');
    Route::get('/user/{user:name}', [UserController::class, 'show'])->name('user.profile');
    Route::get('/user/{user:name}/loan', [UserController::class, 'userLoans'])->name('user.loans');
    Route::get('/user/{user:name}/edit', [UserController::class, 'editprofile'])->name('edit.profile');
    Route::put('/user/{user:name}', [UserController::class, 'updateprofile'])->name('update.profile');
    Route::get('/user/{user:name}/top10', [UserController::class, 'top10'])->name('usertop10.profile');
    Route::get('/user/{user:name}/manageavatar', [UserController::class, 'createAvatar'])->name('createAvatar.profile');
    Route::post('/user/{user:name}/', [UserController::class, 'storeAvatar'])->name('storeAvatar.profile');
});

// Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
// Route::get('/admin/loans', 'App\Http\Controllers\Admin\AdminLoanController@index')->name("admin.loan.index");
// Route::get('/admin/loans/add', 'App\Http\Controllers\Admin\AdminLoanController@add')->name("admin.loan.add");
// Route::post('/admin/loans/store', 'App\Http\Controllers\Admin\AdminLoanController@store')->name("admin.loan.store");
// Route::delete('/admin/loans/{id}/delete', 'App\Http\Controllers\Admin\AdminLoanController@delete')->name("admin.loan.delete");
// Route::get('/admin/loans/{id}/edit', 'App\Http\Controllers\Admin\AdminLoanController@edit')->name("admin.product.edit");
// Route::put('/admin/loans/{id}/update', 'App\Http\Controllers\Admin\AdminLoanController@update')->name("admin.product.update");


Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');



//   "publicKey" => "BBq7w06lwmQXB6ftYLNinTzUA6NDO9K3DV2ZHKh-wSUqTAH9vxk5JAqN1XxlQ5SYZiEw0obNASpTolAa1z1dESM"
//   "privateKey" => "tgnl1VKdd-gVySY4GPffxLLDX8nJbAcp2IsT3dKqICg"


Route::get('/live',function (){
    return view('live');
});


