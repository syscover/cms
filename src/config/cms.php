<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cms
    |--------------------------------------------------------------------------
    |
    | Routes to public folders
    |
    */

    'libraryFolder'         => '/packages/syscover/cms/storage/library',
    'tmpFolder'             => '/packages/syscover/cms/storage/tmp',
    'attachmentFolder'      => '/packages/syscover/cms/storage/attachment',
    'iconsFolder'           => '/packages/syscover/pulsar/images/icons',

    /*
    |--------------------------------------------------------------------------
    | Comunik
    |--------------------------------------------------------------------------
    |
    | Routes to themes folder
    |
    */

    'themesFolder'          => '/packages/syscover/cms/themes/',

    //******************************************************************************************************************
    //***   Type fields to select on fields section
    //******************************************************************************************************************
    'editors'                => [
        (object)['id' => 1, 'name' => 'Wysiwyg'],
        (object)['id' => 2, 'name' => 'Contentbuilder'],
    ],
];