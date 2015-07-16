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
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Pulsar\Libraries\Miscellaneous;
use Syscover\Cms\Models\File;

class FileController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsFile';
    protected $folder       = 'attachment';
    protected $package      = 'cms';
    protected $aColumns     = ['id_354', 'file_name_354', 'mime_354', 'size_354', 'width_354', 'width_354', 'height_354', 'data_354'];
    protected $nameM        = 'file_354';
    protected $model        = '\Syscover\Cms\Models\File';
    protected $icon         = 'sys-icon-magnet';
    protected $objectTrans  = 'file';

    public function storeFile(HttpRequest $request)
    {
        $parameters = $request->route()->parameters();
        $files      = $request->input('files');
        //$uri        = $parameters['newArticle'] == 1? 'packages/syscover/cms/storage/tmp' : 'packages/syscover/cms/storage/library';
        $uri        = 'packages/syscover/cms/storage/library';
        $path       = public_path() . '/' . $uri;
        $objects            = [];
        $objectsResponse    = [];

        for($i = 0; $i < count($files); $i++)
        {
            if($files[$i]['isImage'] == 'true')
            {
                list($files[$i]['width'], $files[$i]['height']) = getimagesize($path . '/' . $files[$i]['name']);
            }

            $objects[] = [
                'file_name_354' => $files[$i]['name'],
                'mime_354'      => $files[$i]['mime'],
                'size_354'      => $files[$i]['size'],
                'is_image_354'  => $files[$i]['isImage'] == 'true'? true : false,
                'width_354'     => isset($files[$i]['width'])? $files[$i]['width'] : null,
                'height_354'    => isset($files[$i]['height'])? $files[$i]['height'] : null,
                'data_354'      => null
            ];

            $objectsResponse[] = $files[$i];
        }

        File::insert($objects);

        $response = [
            'success' => true,
            'files'   => $objectsResponse
        ];

        return response()->json($response);
    }
    
    public function updateCustomRecord($parameters)
    {
        Section::where('id_350', $parameters['id'])->update([
            'id_350'                => Request::input('id'),
            'name_350'              => Request::input('name'),
            'article_family_350'    => Request::has('family')? Request::input('family') : null
        ]);
    }

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


            case 'office':
                return ["image/gif", "image/jpeg", "image/pjpeg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png"];
                break;
            case 'docs':
                return "i es igual a 1";
                break;
            case 'spreadsheets':
                echo "i es igual a 2";
                break;
            case 'slides':
                return "i es igual a 2";
                break;
            case 'files':
                return "i es igual a 2";
                break;
            case 'all':
                return ["image/gif", "image/jpeg", "image/pjpeg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png"];
                break;
        }
    }
}