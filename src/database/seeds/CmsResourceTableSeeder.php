<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class CmsResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'cms',                 'name_007' => 'CMS Package',        'package_id_007' => '13'],
            ['id_007' => 'cms-article',         'name_007' => 'Articles',           'package_id_007' => '13'],
            ['id_007' => 'cms-article-family',  'name_007' => 'Article families',   'package_id_007' => '13'],
            ['id_007' => 'cms-category',        'name_007' => 'Categories',         'package_id_007' => '13'],
            ['id_007' => 'cms-section',         'name_007' => 'Sections',           'package_id_007' => '13']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="CmsResourceTableSeeder"
 */