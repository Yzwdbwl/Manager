<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::group(['middleware' => [ 'acl']], function() {

        Route::any('{module}-{class}-{action}.html', ['as' => 'common', function($module, $class, $action)
        {

            $class = 'App\\Http\\Controllers\\Admin\\'.ucfirst(strtolower($module)).'\\'.ucfirst(strtolower($class)).'Controller';

            if(class_exists($class))
            {
                $classObject = new $class();
                if(method_exists($classObject, $action)) return call_user_func(array($classObject, $action));
            }
            return abort(501);
        }])->where(['module' => '[0-9a-z]+', 'class' => '[0-9a-z]+', 'action' => '[0-9a-z]+']);
    });
});

require __DIR__.'/auth.php';


