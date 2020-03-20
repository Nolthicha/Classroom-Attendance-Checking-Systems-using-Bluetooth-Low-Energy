<?php


use Carbon\Carbon;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/carbon', function () {
    $now = new Carbon();

    dd($now);
});


# route group with middleware
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/addregister', 'Admin\DashboardController@addregister');

    Route::get('/role-register', 'Admin\DashboardController@registered');

    Route::get('/role-edit/{id}', 'Admin\DashboardController@registeredit')->name('role-edit');

    Route::put('/role-register-update/{id}', 'Admin\DashboardController@registerupdate');

    Route::delete('/role-delete/{id}', 'Admin\DashboardController@registerdelete');

    Route::get('/manage-subject', 'Admin\ManageSubjectController@index');

    Route::post('/save-subject', 'Admin\ManageSubjectController@store');

    Route::get('/subject-edit/{id}', 'Admin\ManageSubjectController@edit');

    Route::put('/subject-update/{id}', 'Admin\ManageSubjectController@update');

    Route::delete('subject-delete/{id}', 'Admin\ManageSubjectController@delete');
});


# route group with prefix 'course' and middleware is 'teacher'

Route::group(['prefix' => 'course', 'middleware' => ['auth', 'teacher']], function () {

    #show course
    Route::get('/index', 'CourseController@index');

    //edit course
    //Route::get('/course-edit/{subject_id}','CourseController@course_edit');
    //Route::put('/course-update/{subject_id}','CourseController@course_update');


    #subject index + edit subject + add subject

    Route::get('/subject/{subject_id}', 'CourseController@subject')->name('subject.course');

    Route::get('/subject-edit/{id}', 'CourseController@edit');
    Route::put('/subject-update/{id}', 'CourseController@update');

    Route::get('/savepage/{subject_id}', 'CourseController@savepage')->name('savepage.course');
    Route::post('/save-subject', 'CourseController@savelist')->name('save.course');


    #shearch subject
    Route::get('/calendar', 'SearchController@index');
    Route::get('/calendar/search', 'SearchController@action')->name('search.action');

    #std register shubject and count check classroom
    Route::get('/std_detail', 'BLEController@std_index');
    Route::get('/std_detail/{subject_id}', 'BLEController@std_show')->name('std.course');
    Route::get('/std_detail/{subject_id}/{std_id}', 'BLEController@countStd');

    #show std now today
    Route::get('/std_now', 'BLEController@check')->name('std_now.course');
    Route::get('/std_now/{subject_id}', 'SearchController@compareTime')->name('std_now_show.course');

    #show std back
    Route::get('/std_back_sub', 'SearchController@subBack');
    Route::get('/std_back/{subject_id}', 'SearchController@indexBack')->name('std_back.course');
    Route::get('/std_back_show/{subject_id}/{date}', 'SearchController@dateBack')->name('std_back_show.course');


    #show page create
    Route::get('/create', function () {
        return view('course/create');
    });

    #create course+subject
    Route::post('/create', 'CourseController@store')->name('create.course');

    #show subject + choose open BLE
    Route::get('/ble', 'BLEController@index')->name('ble.course');
    Route::post('/attendance', 'BLEController@store')->name('storeAtt.course');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
