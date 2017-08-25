<?php

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

Route::prefix('admin')->group(function () {
    Route::get('create', function () {
        $obj = new Backend\framework\adaptors\http\Gateway();
        return $obj->create();
    });
});


Route::prefix('admin')->group(function () {

    Route::get('index', function () {
        $obj = new Backend\framework\adaptors\http\Gateway();
        return $obj->index();
    });

    /**
     * very simple - this could be automated
     *
     */
        Route::get('show', function () {
            if(\Illuminate\Support\Facades\Input::get('filter')) {
                $obj = new Backend\framework\adaptors\http\Gateway();
                return $obj->show_filter();
            }
            $obj = new Backend\framework\adaptors\http\Gateway();
            return $obj->show();

        });

});