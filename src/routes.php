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
    | IMAGES
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.appName') . '/cms/archives/images',                                       ['as'=>'loadCmsImages',                 'uses'=>'Syscover\Cms\Controllers\FilesManager@loadImages',                 'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/archives/images/delete',                               ['as'=>'deleteCmsImages',               'uses'=>'Syscover\Cms\Controllers\FilesManager@deleteImages',               'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/archives/images/uploads',                              ['as'=>'uploadCmsImages',               'uses'=>'Syscover\Cms\Controllers\FilesManager@uploadImages',               'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/archives/files/uploads',                               ['as'=>'uploadCmsFiles',                'uses'=>'Syscover\Cms\Controllers\FilesManager@uploadFiles',                'resource' => 'cms-article',        'action' => 'create']);

    /*
    |--------------------------------------------------------------------------
    | ARTICLES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/articles/{lang}/{offset?}',                              ['as'=>'CmsArticle',                     'uses'=>'Syscover\Cms\Controllers\Articles@index',                      'resource' => 'cms-article',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/articles/json/data/{lang}',                              ['as'=>'jsonDataCmsArticle',             'uses'=>'Syscover\Cms\Controllers\Articles@jsonData',                   'resource' => 'cms-article',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/articles/create/{lang}/{offset}/{tab}/{id?}',            ['as'=>'createCmsArticle',               'uses'=>'Syscover\Cms\Controllers\Articles@createRecord',               'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/articles/store/{lang}/{offset}/{id?}',                  ['as'=>'storeCmsArticle',                'uses'=>'Syscover\Cms\Controllers\Articles@storeRecord',                'resource' => 'cms-article',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/articles/{id}/edit/{lang}/{offset}',                     ['as'=>'editCmsArticle',                 'uses'=>'Syscover\Cms\Controllers\Articles@editRecord',                 'resource' => 'cms-article',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/articles/update/{lang}/{id}/{offset}',                   ['as'=>'updateCmsArticle',               'uses'=>'Syscover\Cms\Controllers\Articles@updateRecord',               'resource' => 'cms-article',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/articles/delete/{lang}/{id}/{offset}',                   ['as'=>'deleteCmsArticle',               'uses'=>'Syscover\Cms\Controllers\Articles@deleteRecord',               'resource' => 'cms-article',        'action' => 'delete']);
    Route::get(config('pulsar.appName') . '/cms/articles/delete/translation/{lang}/{id}/{offset}',       ['as'=>'deleteTranslationCmsArticle',    'uses'=>'Syscover\Cms\Controllers\Articles@deleteTranslationRecord',    'resource' => 'cms-article',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/articles/delete/select/records/{lang}',               ['as'=>'deleteSelectCmsArticle',         'uses'=>'Syscover\Cms\Controllers\Articles@deleteRecordsSelect',        'resource' => 'cms-article',        'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/categories/{lang}/{offset?}',                              ['as'=>'CmsCategory',                     'uses'=>'Syscover\Cms\Controllers\Categories@index',                      'resource' => 'cms-category',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/categories/json/data/{lang}',                              ['as'=>'jsonDataCmsCategory',             'uses'=>'Syscover\Cms\Controllers\Categories@jsonData',                   'resource' => 'cms-category',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/categories/create/{lang}/{offset}/{id?}',                  ['as'=>'createCmsCategory',               'uses'=>'Syscover\Cms\Controllers\Categories@createRecord',               'resource' => 'cms-category',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/categories/store/{lang}/{offset}/{id?}',                  ['as'=>'storeCmsCategory',                'uses'=>'Syscover\Cms\Controllers\Categories@storeRecord',                'resource' => 'cms-category',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/categories/{id}/edit/{lang}/{offset}',                     ['as'=>'editCmsCategory',                 'uses'=>'Syscover\Cms\Controllers\Categories@editRecord',                 'resource' => 'cms-category',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/categories/update/{lang}/{id}/{offset}',                   ['as'=>'updateCmsCategory',               'uses'=>'Syscover\Cms\Controllers\Categories@updateRecord',               'resource' => 'cms-category',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/categories/delete/{lang}/{id}/{offset}',                   ['as'=>'deleteCmsCategory',               'uses'=>'Syscover\Cms\Controllers\Categories@deleteRecord',               'resource' => 'cms-category',        'action' => 'delete']);
    Route::get(config('pulsar.appName') . '/cms/categories/delete/translation/{lang}/{id}/{offset}',       ['as'=>'deleteTranslationCmsCategory',    'uses'=>'Syscover\Cms\Controllers\Categories@deleteTranslationRecord',    'resource' => 'cms-category',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/categories/delete/select/records/{lang}',               ['as'=>'deleteSelectCmsCategory',         'uses'=>'Syscover\Cms\Controllers\Categories@deleteRecordsSelect',        'resource' => 'cms-category',        'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | ARTICLE FAMILIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/article/families/{offset?}',                          ['as'=>'CmsArticleFamily',                   'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@index',                      'resource' => 'cms-article-families',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/article/families/json/data',                          ['as'=>'jsonDataCmsArticleFamily',           'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@jsonData',                   'resource' => 'cms-article-families',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/article/families/create/{offset}',                    ['as'=>'createCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@createRecord',               'resource' => 'cms-article-families',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/article/families/store/{offset}',                    ['as'=>'storeCmsArticleFamily',              'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@storeRecord',                'resource' => 'cms-article-families',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/article/families/{id}/edit/{offset}',                 ['as'=>'editCmsArticleFamily',               'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@editRecord',                 'resource' => 'cms-article-families',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/article/families/update/{id}/{offset}',               ['as'=>'updateCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@updateRecord',               'resource' => 'cms-article-families',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/article/families/delete/{id}/{offset}',               ['as'=>'deleteCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@deleteRecord',               'resource' => 'cms-article-families',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/article/families/delete/select/records',           ['as'=>'deleteSelectCmsArticleFamily',       'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@deleteRecordsSelect',        'resource' => 'cms-article-families',        'action' => 'delete']);
    Route::any(config('pulsar.appName') . '/cms/article/families/{id}/show/{api}',                    ['as'=>'apiShowCmsArticleFamily',            'uses'=>'Syscover\Cms\Controllers\ArticleFamilies@showRecord',                 'resource' => 'cms-article-families',        'action' => 'access']);

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
    Route::any(config('pulsar.appName') . '/cms/section/{id}/show/{api}',                    ['as'=>'apiShowCmsSection',            'uses'=>'Syscover\Cms\Controllers\Sections@showRecord',                 'resource' => 'cms-section',        'action' => 'access']);
});