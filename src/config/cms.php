<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CMS attachment url
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
    | CMS theme folder
    |--------------------------------------------------------------------------
    |
    | Routes to themes folder to content builder
    |
    */

    'themesFolder'          => '/packages/syscover/cms/themes/',

    /*
    |--------------------------------------------------------------------------
    | CMS type editor
    |--------------------------------------------------------------------------
    |
    | Editor types to article
    |
    */
    'editors'                => [
        (object)['id' => 1, 'name' => 'Wysiwyg'],
        (object)['id' => 2, 'name' => 'Contentbuilder'],
        (object)['id' => 3, 'name' => 'TextArea'],
    ],
];