<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Package;

class CmsPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id_012' => '13', 'name_012' => 'CMS Package', 'folder_012' => 'cms', 'sorting_012' => 13, 'active_012' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="CmsPackageTableSeeder"
 */