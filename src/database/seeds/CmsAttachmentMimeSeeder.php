<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\AttachmentMime;

class CmsAttachmentMimeSeeder extends Seeder
{
    public function run()
    {
        AttachmentMime::insert([
            ['resource_id_019' => 'cms-article', 'mime_019' => 'image/jpeg'],
            ['resource_id_019' => 'cms-article', 'mime_019' => 'image/png'],
            ['resource_id_019' => 'cms-article', 'mime_019' => 'application/pdf'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="CmsAttachmentMimeSeeder"
 */