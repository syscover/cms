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

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | FILES
    |--------------------------------------------------------------------------
    */
    Route::get(config('pulsar.appName') . '/cms/files/{type}',                  ['as'=>'apiWysiwygCmsFile',         'uses'=>'Syscover\Cms\Controllers\FileController@getFilesWysiwyg',      'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/archives/images/delete',       ['as'=>'apiWysiwygDeleteCmsFile',   'uses'=>'Syscover\Cms\Controllers\FileController@deleteFilesWysiwyg',   'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/files/upload/{type}',          ['as'=>'apiWysiwygUploadCmsFile',   'uses'=>'Syscover\Cms\Controllers\FileController@uploadFilesWysiwyg',   'resource' => 'cms-article',        'action' => 'create']);

    /*
    |--------------------------------------------------------------------------
    | ARTICLES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/articles/{lang}/{offset?}',                              ['as'=>'CmsArticle',                     'uses'=>'Syscover\Cms\Controllers\ArticleController@index',                      'resource' => 'cms-article',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/articles/json/data/{lang}',                              ['as'=>'jsonDataCmsArticle',             'uses'=>'Syscover\Cms\Controllers\ArticleController@jsonData',                   'resource' => 'cms-article',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/articles/create/{lang}/{offset}/{tab}/{id?}',            ['as'=>'createCmsArticle',               'uses'=>'Syscover\Cms\Controllers\ArticleController@createRecord',               'resource' => 'cms-article',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/articles/store/{lang}/{offset}/{tab}/{id?}',            ['as'=>'storeCmsArticle',                'uses'=>'Syscover\Cms\Controllers\ArticleController@storeRecord',                'resource' => 'cms-article',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/articles/{id}/edit/{lang}/{offset}/{tab}',               ['as'=>'editCmsArticle',                 'uses'=>'Syscover\Cms\Controllers\ArticleController@editRecord',                 'resource' => 'cms-article',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/articles/update/{lang}/{id}/{offset}/{tab}',             ['as'=>'updateCmsArticle',               'uses'=>'Syscover\Cms\Controllers\ArticleController@updateRecord',               'resource' => 'cms-article',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/articles/delete/{lang}/{id}/{offset}',                   ['as'=>'deleteCmsArticle',               'uses'=>'Syscover\Cms\Controllers\ArticleController@deleteRecord',               'resource' => 'cms-article',        'action' => 'delete']);
    Route::get(config('pulsar.appName') . '/cms/articles/delete/translation/{lang}/{id}/{offset}/{tab}', ['as'=>'deleteTranslationCmsArticle',    'uses'=>'Syscover\Cms\Controllers\ArticleController@deleteTranslationRecord',    'resource' => 'cms-article',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/articles/delete/select/records/{lang}',               ['as'=>'deleteSelectCmsArticle',         'uses'=>'Syscover\Cms\Controllers\ArticleController@deleteRecordsSelect',        'resource' => 'cms-article',        'action' => 'delete']);
    Route::post(config('pulsar.appName') . '/cms/articles/check/article/slug',                           ['as'=>'apiCheckSlugCmsArticle',         'uses'=>'Syscover\Cms\Controllers\ArticleController@apiCheckSlug',               'resource' => 'cms-article',        'action' => 'access']);

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/categories/{lang}/{offset?}',                              ['as'=>'CmsCategory',                     'uses'=>'Syscover\Cms\Controllers\CategoryController@index',                      'resource' => 'cms-category',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/categories/json/data/{lang}',                              ['as'=>'jsonDataCmsCategory',             'uses'=>'Syscover\Cms\Controllers\CategoryController@jsonData',                   'resource' => 'cms-category',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/categories/create/{lang}/{offset}/{id?}',                  ['as'=>'createCmsCategory',               'uses'=>'Syscover\Cms\Controllers\CategoryController@createRecord',               'resource' => 'cms-category',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/categories/store/{lang}/{offset}/{id?}',                  ['as'=>'storeCmsCategory',                'uses'=>'Syscover\Cms\Controllers\CategoryController@storeRecord',                'resource' => 'cms-category',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/categories/{id}/edit/{lang}/{offset}',                     ['as'=>'editCmsCategory',                 'uses'=>'Syscover\Cms\Controllers\CategoryController@editRecord',                 'resource' => 'cms-category',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/categories/update/{lang}/{id}/{offset}',                   ['as'=>'updateCmsCategory',               'uses'=>'Syscover\Cms\Controllers\CategoryController@updateRecord',               'resource' => 'cms-category',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/categories/delete/{lang}/{id}/{offset}',                   ['as'=>'deleteCmsCategory',               'uses'=>'Syscover\Cms\Controllers\CategoryController@deleteRecord',               'resource' => 'cms-category',        'action' => 'delete']);
    Route::get(config('pulsar.appName') . '/cms/categories/delete/translation/{lang}/{id}/{offset}',       ['as'=>'deleteTranslationCmsCategory',    'uses'=>'Syscover\Cms\Controllers\CategoryController@deleteTranslationRecord',    'resource' => 'cms-category',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/categories/delete/select/records/{lang}',               ['as'=>'deleteSelectCmsCategory',         'uses'=>'Syscover\Cms\Controllers\CategoryController@deleteRecordsSelect',        'resource' => 'cms-category',        'action' => 'delete']);
    Route::post(config('pulsar.appName') . '/cms/categories/check/category/slug',                          ['as'=>'apiCheckSlugCmsCategory',         'uses'=>'Syscover\Cms\Controllers\CategoryController@apiCheckSlug',               'resource' => 'cms-category',        'action' => 'access']);

    /*
    |--------------------------------------------------------------------------
    | ARTICLE FAMILIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/article/families/{offset?}',                          ['as'=>'CmsArticleFamily',                   'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@index',                      'resource' => 'cms-article-family',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/article/families/json/data',                          ['as'=>'jsonDataCmsArticleFamily',           'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@jsonData',                   'resource' => 'cms-article-family',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/article/families/create/{offset}',                    ['as'=>'createCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@createRecord',               'resource' => 'cms-article-family',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/article/families/store/{offset}',                    ['as'=>'storeCmsArticleFamily',              'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@storeRecord',                'resource' => 'cms-article-family',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/article/families/{id}/edit/{offset}',                 ['as'=>'editCmsArticleFamily',               'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@editRecord',                 'resource' => 'cms-article-family',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/article/families/update/{id}/{offset}',               ['as'=>'updateCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@updateRecord',               'resource' => 'cms-article-family',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/article/families/delete/{id}/{offset}',               ['as'=>'deleteCmsArticleFamily',             'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@deleteRecord',               'resource' => 'cms-article-family',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/article/families/delete/select/records',           ['as'=>'deleteSelectCmsArticleFamily',       'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@deleteRecordsSelect',        'resource' => 'cms-article-family',        'action' => 'delete']);
    Route::any(config('pulsar.appName') . '/cms/article/families/{id}/show/{api}',                    ['as'=>'apiShowCmsArticleFamily',            'uses'=>'Syscover\Cms\Controllers\ArticleFamilyController@showRecord',                 'resource' => 'cms-article-family',        'action' => 'access']);

    /*
    |--------------------------------------------------------------------------
    | SECTIONS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/cms/section/{offset?}',                          ['as'=>'CmsSection',                   'uses'=>'Syscover\Cms\Controllers\SectionController@index',                      'resource' => 'cms-section',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/cms/section/json/data',                          ['as'=>'jsonDataCmsSection',           'uses'=>'Syscover\Cms\Controllers\SectionController@jsonData',                   'resource' => 'cms-section',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/cms/section/create/{offset}',                    ['as'=>'createCmsSection',             'uses'=>'Syscover\Cms\Controllers\SectionController@createRecord',               'resource' => 'cms-section',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/cms/section/store/{offset}',                    ['as'=>'storeCmsSection',              'uses'=>'Syscover\Cms\Controllers\SectionController@storeRecord',                'resource' => 'cms-section',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/cms/section/{id}/edit/{offset}',                 ['as'=>'editCmsSection',               'uses'=>'Syscover\Cms\Controllers\SectionController@editRecord',                 'resource' => 'cms-section',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/cms/section/update/{id}/{offset}',               ['as'=>'updateCmsSection',             'uses'=>'Syscover\Cms\Controllers\SectionController@updateRecord',               'resource' => 'cms-section',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/cms/section/delete/{id}/{offset}',               ['as'=>'deleteCmsSection',             'uses'=>'Syscover\Cms\Controllers\SectionController@deleteRecord',               'resource' => 'cms-section',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/cms/section/delete/select/records',           ['as'=>'deleteSelectCmsSection',       'uses'=>'Syscover\Cms\Controllers\SectionController@deleteRecordsSelect',        'resource' => 'cms-section',        'action' => 'delete']);
    Route::any(config('pulsar.appName') . '/cms/section/{id}/show/{api}',                    ['as'=>'apiShowCmsSection',            'uses'=>'Syscover\Cms\Controllers\SectionController@showRecord',                 'resource' => 'cms-section',        'action' => 'access']);
});