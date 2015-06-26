<?php namespace Syscover\Cms\Controllers;

/**
 * @package	    Cms
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Libraries\Miscellaneous;

class FilesManager extends Controller {

    public function loadImages()
    {
        $uri        = public_path() . '/packages/syscover/pulsar/storage/uploads';
        $response   = [];
        $imageTypes = ["image/gif", "image/jpeg", "image/pjpeg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png"];

        $fnames = scandir($uri);

        if ($fnames)
        {
            foreach ($fnames as $name)
            {
                if (!is_dir($name))
                {
                    if (in_array(mime_content_type($uri . "/" . $name), $imageTypes))
                    {
                        $response[] = asset('packages/syscover/pulsar/storage/uploads/' . $name);
                    }
                }
            }
        }
        else
        {
            $response = [
                'success' => false,
                'message' => "Images folder does not exist!"
            ];
        }

        return response()->json($response);
    }

    public function deleteImages(Request $request)
    {
        $src = $request->input('src');
        $src = public_path() . parse_url($src, PHP_URL_PATH);
        if (file_exists($src))
        {
            if(File::delete($src))
            {
                $response = [
                    'success' => true,
                    'message' => "Image delete!"
                ];
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => "Image does not exist!"
                ];
            }
        }

        return response()->json($response);
    }

    public function uploadImages(Request $request)
    {
        $uri            = public_path() . '/packages/syscover/pulsar/storage/uploads';
        $allowedExts    = ["gif", "jpeg", "jpg", "png"];
        $file           = $request->file('file');
        $extension      = $file->getClientOriginalExtension();
        $mime           = $file->getClientMimeType();

        if ((($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/pjpeg") || ($mime == "image/x-png") || ($mime == "image/png")) && in_array($extension, $allowedExts))
        {
            $name = Miscellaneous::uploadFiles('file', $uri);

            $response = [
                'success'   => true,
                'link'      =>  asset('packages/syscover/pulsar/storage/uploads/' . $name)
            ];

            return response()->json($response);
        }
    }

    public function uploadFiles(Request $request)
    {
        $uri            = public_path() . '/packages/syscover/pulsar/storage/uploads';
        $allowedExts    = ["txt", "pdf", "doc"];
        $file           = $request->file('file');
        $extension      = $file->getClientOriginalExtension();
        $mime           = $file->getClientMimeType();

        if ((($mime == "text/plain") || ($mime == "application/msword") || ($mime == "application/x-pdf") || ($mime == "application/pdf")) && in_array($extension, $allowedExts))
        {
            $name = Miscellaneous::uploadFiles('file', $uri);

            $response = [
                'success'   => true,
                'link'      =>  asset('packages/syscover/pulsar/storage/uploads/' . $name)
            ];

            return response()->json($response);
        }
    }
}