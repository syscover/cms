<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can any all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['middleware' => ['auth.pulsar','permission.pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | SECTIONS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/section/{offset?}',                          ['as'=>'CmsSection',                   'uses'=>'Syscover\Cms\Controllers\Sections@index',                      'resource' => 'cms-section',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/section/json/data',                          ['as'=>'jsonDataCmsSection',           'uses'=>'Syscover\Cms\Controllers\Sections@jsonData',                   'resource' => 'cms-section',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/section/create/{offset}',                    ['as'=>'createCmsSection',             'uses'=>'Syscover\Cms\Controllers\Sections@createRecord',               'resource' => 'cms-section',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/section/store/{offset}',                    ['as'=>'storeCmsSection',              'uses'=>'Syscover\Cms\Controllers\Sections@storeRecord',                'resource' => 'cms-section',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/section/{id}/edit/{offset}',                 ['as'=>'editCmsSection',               'uses'=>'Syscover\Cms\Controllers\Sections@editRecord',                 'resource' => 'cms-section',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/section/update/{id}/{offset}',               ['as'=>'updateCmsSection',             'uses'=>'Syscover\Cms\Controllers\Sections@updateRecord',               'resource' => 'cms-section',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/section/delete/{id}/{offset}',               ['as'=>'deleteCmsSection',             'uses'=>'Syscover\Cms\Controllers\Sections@deleteRecord',               'resource' => 'cms-section',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/section/delete/select/records',           ['as'=>'deleteSelectCmsSection',       'uses'=>'Syscover\Cms\Controllers\Sections@deleteRecordsSelect',        'resource' => 'cms-section',        'action' => 'delete']);

});