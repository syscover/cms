<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CmsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(CmsPackageTableSeeder::class);
        $this->call(CmsResourceTableSeeder::class);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="CmsTableSeeder"
 */