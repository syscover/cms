<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class ResourceCmsTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'cms','name_007' => 'CMS Package','package_007' => '13'],
            ['id_007' => 'cms-article','name_007' => 'Articles','package_007' => '13'],
            ['id_007' => 'cms-article-family','name_007' => 'Article families','package_007' => '13'],
            ['id_007' => 'cms-attachment-family','name_007' => 'Attachment families','package_007' => '13'],
            ['id_007' => 'cms-category','name_007' => 'Categories','package_007' => '13'],
            ['id_007' => 'cms-library','name_007' => 'Library','package_007' => '13'],
            ['id_007' => 'cms-section','name_007' => 'Sections','package_007' => '13']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="ResourceCmsTableSeeder"
 */