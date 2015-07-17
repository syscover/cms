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

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\File as FileFacade;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Libraries\Miscellaneous;

class FileController extends Controller {

    public function getFilesWysiwyg(HttpRequest $request)
    {
        $parameters     = $request->route()->parameters();
        $uri            = 'packages/syscover/cms/storage/wysiwyg';
        $path           = public_path() . '/' . $uri;
        $response       = [];
        $types          = $this->getTypes($parameters['type']);

        $fnames = scandir($path);

        if ($fnames)
        {
            foreach ($fnames as $name)
            {
                if (!is_dir($name))
                {
                    if (in_array(mime_content_type($path . "/" . $name), $types['mime']))
                    {
                        $response[] = asset($uri. '/' . $name);
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

    public function uploadFilesWysiwyg(HttpRequest $request)
    {
        $parameters     = $request->route()->parameters();
        $uri            = 'packages/syscover/cms/storage/wysiwyg';
        $path           = public_path() . '/' . $uri;
        $types          = $this->getTypes($parameters['type']);

        $file           = $request->file('file');
        $extension      = $file->getClientOriginalExtension();
        $mime           = $file->getClientMimeType();

        if (in_array($mime, $types['mime']) && in_array($extension, $types['extension']))
        {
            $name = Miscellaneous::uploadFiles('file', $path);

            $response = [
                'success'   => true,
                'link'      =>  asset($uri . '/' . $name)
            ];

            return response()->json($response);
        }
    }

    public function deleteFilesWysiwyg(HttpRequest $request)
    {
        $src = $request->input('src');
        $src = public_path() . parse_url($src, PHP_URL_PATH);
        if (file_exists($src))
        {
            if(FileFacade::delete($src))
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

    private function getTypes($key)
    {
        switch ($key) {
            case 'images':
                return [
                    'mime'      => ["image/gif", "image/jpeg", "image/pjpeg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/svg+xml"],
                    'extension' => ["gif", "jpeg", "jpg", "png", "svg"]
                ];
                break;
            case 'files':
                return [
                    'mime'      => ["text/plain", "application/msword", "application/x-pdf", "application/pdf"],
                    'extension' => ["txt", "pdf", "doc"]
                ];
                break;
        }
    }
}