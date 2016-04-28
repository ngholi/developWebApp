<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function(){
        return redirect('/department');
    });

    Route::group(array('middleware' => ['guest']), function(){
        Route::get('/login', 'UserController@login');
        Route::post('/login', array('as' => 'user.login', 'uses' => 'UserController@authenticate'));
    });
    Route::group(array('middleware' => ['auth']), function(){
        Route::get('/changepass', array('as' => 'user.showchangepass', 'uses' => 'UserController@showChangePass'));
        Route::post('/changepass', array('as' => 'user.changepass', 'uses' => 'UserController@doChangePass'));
        Route::get('/logout', array('as' => 'user.logout', 'uses' =>'UserController@logout'));
        Route::get('/register', array('as' => 'user.register', 'uses' => 'UserController@showRegister'))->middleware(['cpf']);
        Route::post('/register', array('as' => 'user.doregister', 'uses' => 'UserController@doRegister'))->middleware(['cpf']);
    });

    Route::group(array('prefix' => 'department', 'middleware' => ['cpf']), function(){
        Route::get('/', array('as'=>'department','uses'=>'DepartmentController@index'));
        Route::get('/profile/{dep_id}',array('as' => 'department.profile', 'uses' => 'DepartmentController@profile'));
        Route::group(['middleware' => ['auth']], function(){
			Route::get('/add', array('as' => 'department.add', 'uses' => 'DepartmentController@add'));
            Route::post('/edit',array('as' => 'department.edit', 'uses' => 'DepartmentController@edit'));
            Route::get('/edit/{dep_id}',array('uses' => 'DepartmentController@add'));
            Route::get('/{dep_id}/list',array('uses' => 'DepartmentController@employeeList'));
            Route::delete('/delete',array('as' => 'department.delete', 'uses' => 'DepartmentController@delete'));
        });
    });

    Route::group(array('prefix' => 'employee', 'middleware' => ['cpf']), function(){
        Route::get('/', array('as' => 'employee', 'uses' => 'EmployeeController@index'));
        Route::post('/search',array('as' => 'employee.search' , 'uses' => 'EmployeeController@search'));
        Route::get('/profile/{emp_id}', array('as' => 'employee.profile', 'uses' => 'EmployeeController@profile'));
        Route::group(['middleware' => ['auth']], function(){
            Route::get('/add', array('as' => 'employee.add', 'uses' => 'EmployeeController@add'));
            Route::post('/edit', array('as' => 'employee.edit', 'uses' => 'EmployeeController@edit'));
            Route::get('/edit/{emp_id}', array('as' => 'employee.modify', 'uses' => 'EmployeeController@add'));

            Route::delete('/delete',array('as' => 'employee.delete' , 'uses' => 'EmployeeController@delete'));
        });
    });

});
