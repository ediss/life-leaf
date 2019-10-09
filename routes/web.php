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

Route::get('/', function () {
    return view('home.home');
});

Auth::routes();

Route::redirect('/home', '/kursevi');

Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/kursevi',              'HomeController@index')->middleware('check-ip') ->name('courses');
Route::get('/kursevi/kurs/{id}',    'TutorialController@singleTutorial')            ->name('tutorial');
Route::get('/ne-dozvoljen-pristup', 'SecurityController@notAllowedLogin');
Route::post('/kurs/koment-test',     'CommentController@store')                     ->name('comments.store');


Route::prefix('aadmin')->group(function() {
    Route::get('/login',                'Auth\AdminLoginController@showLoginForm')  ->name('admin.login');
    Route::post('/login',               'Auth\AdminLoginController@login')          ->name('admin.login.submit');
    Route::any('/admin-logout',         'Auth\AdminLoginController@adminLogout')    ->name('admin.logout');

    Route::get('/',                     'AdminController@index')                    ->name('admin.dashboard');
    Route::prefix('/kursevi')->group(function() {
        Route::get('/unos-kursa',   'AdminController@addCourse')                    ->name('admin.insert.tutorial');
        Route::post('/unos-kursa',  'AdminController@addCourse')                    ->name('admin.insert.tutorial.submit');
    });

    Route::prefix('/pacijenti')->middleware('check-patient-accesss')->group(function() {
        Route::get('/unos-pacijenta',       'AdminController@addPatient')                    ->name('admin.insert.patient');
        Route::post('/unos-pacijenta',      'AdminController@addPatient')                    ->name('admin.insert.patient.submit');


        Route::get('/unos-sesije/{id?}',    'AdminController@addSession')                    ->name('admin.insert.session');
        Route::post('/unos-sesije/{id?}',   'AdminController@addSession')                    ->name('admin.insert.session.submit');

        Route::get('/statistika/{tab_name?}','AdminController@showStatistic')                 ->name('admin.show.statistic');
        Route::any('/statistika/pacijenti', 'AdminController@getPatients')                   ->name('admin.patients.statistic.submit');

        Route::any('/statistika/sesije',    'AdminController@getSessions')                   ->name('admin.sessions.statistic.submit');

        Route::any('/izmena-placeno{id}',   'AdminController@updateSessionStatus')           ->name('admin.update.session.paid.status.submit');
        Route::any('/izmena-sesije/{id}',   'AdminController@updateSession')                 ->name('admin.session.update');

        Route::any('/pacijent/{id?}',       'AdminController@patientProfile')                ->name('admin.patient.profile');

        Route::any('/pacijent/izmena/{id}', 'AdminController@editPatient')                   ->name('admin.patient.update');
        Route::any('/pacijent/brisanje/{id}', 'AdminController@deletePatient')               ->name('admin.patient.delete');
    });
    
    
    Route::post('/password-update/{id}', 'AdminController@updatePassword')          ->name('admin.password.update');


});

Route::prefix('klijenti')->group(function() {
    Route::get('/unos-novog-klijenta',    'PatientController@index') ->name('insert.patient');
    
    // Route::get('/',         'AdminController@index')                   ->name('admin.dashboard');
});

