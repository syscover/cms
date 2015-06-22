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

Route::group(['middleware' => ['auth.pulsar','permission.pulsar','locale.pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/categories/{offset?}',                          ['as'=>'CmsCategories',                   'uses'=>'Syscover\Cms\Controllers\Categories@index',                      'resource' => 'cms-categories',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/categories/json/data',                          ['as'=>'jsonDataCmsCategories',           'uses'=>'Syscover\Cms\Controllers\Categories@jsonData',                   'resource' => 'cms-categories',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/categories/create/{offset}',                    ['as'=>'createCmsCategories',             'uses'=>'Syscover\Cms\Controllers\Categories@createRecord',               'resource' => 'cms-categories',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/categories/store/{offset}',                    ['as'=>'storeCmsCategories',              'uses'=>'Syscover\Cms\Controllers\Categories@storeRecord',                'resource' => 'cms-categories',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/categories/{id}/edit/{offset}',                 ['as'=>'editCmsCategories',               'uses'=>'Syscover\Cms\Controllers\Categories@editRecord',                 'resource' => 'cms-categories',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/categories/update/{id}/{offset}',               ['as'=>'updateCmsCategories',             'uses'=>'Syscover\Cms\Controllers\Categories@updateRecord',               'resource' => 'cms-categories',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/categories/delete/{id}/{offset}',               ['as'=>'deleteCmsCategories',             'uses'=>'Syscover\Cms\Controllers\Categories@deleteRecord',               'resource' => 'cms-categories',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/categories/delete/select/records',           ['as'=>'deleteSelectCmsCategories',       'uses'=>'Syscover\Cms\Controllers\Categories@deleteRecordsSelect',        'resource' => 'cms-categories',        'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | ARTICLE FAMILIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/article/families/{offset?}',                          ['as'=>'CmsArticleFamilies',                   'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@index',                      'resource' => 'cms-article-families',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/article/families/json/data',                          ['as'=>'jsonDataCmsArticleFamilies',           'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@jsonData',                   'resource' => 'cms-article-families',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/article/families/create/{offset}',                    ['as'=>'createCmsArticleFamilies',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@createRecord',               'resource' => 'cms-article-families',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/article/families/store/{offset}',                    ['as'=>'storeCmsArticleFamilies',              'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@storeRecord',                'resource' => 'cms-article-families',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/article/families/{id}/edit/{offset}',                 ['as'=>'editCmsArticleFamilies',               'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@editRecord',                 'resource' => 'cms-article-families',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/article/families/update/{id}/{offset}',               ['as'=>'updateCmsArticleFamilies',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@updateRecord',               'resource' => 'cms-article-families',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/article/families/delete/{id}/{offset}',               ['as'=>'deleteCmsArticleFamilies',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@deleteRecord',               'resource' => 'cms-article-families',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/article/families/delete/select/records',           ['as'=>'deleteSelectCmsArticleFamilies',       'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@deleteRecordsSelect',        'resource' => 'cms-article-families',        'action' => 'delete']);

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