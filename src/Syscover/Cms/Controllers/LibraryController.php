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
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\Library;

class LibraryController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsFile';
    protected $folder       = 'attachment';
    protected $package      = 'cms';
    protected $aColumns     = ['id_354', 'file_name_354', 'mime_354', 'size_354', 'type_text_354', 'width_354', 'width_354', 'height_354', 'data_354'];
    protected $nameM        = 'file_354';
    protected $model        = '\Syscover\Cms\Models\Library';
    protected $icon         = 'sys-icon-magnet';
    protected $objectTrans  = 'file';

    public function storeLibrary(HttpRequest $request)
    {
        $parameters         = $request->route()->parameters();
        $files              = $request->input('files');
        $uri                = 'packages/syscover/cms/storage/library';
        $path               = public_path() . '/' . $uri;
        $objects            = [];
        $objectsResponse    = [];

        for($i = 0; $i < count($files); $i++)
        {
            if($files[$i]['isImage'] == 'true')
            {
                list($files[$i]['width'], $files[$i]['height']) = getimagesize($path . '/' . $files[$i]['name']);
            }

            $type = $this->getType($files[$i]['mime']);

            $objects[] = [
                'file_name_354' => $files[$i]['name'],
                'mime_354'      => $files[$i]['mime'],
                'size_354'      => $files[$i]['size'],
                'type_354'      => $type['id'],
                'type_text_354' => $type['type'],
                'width_354'     => isset($files[$i]['width'])? $files[$i]['width'] : null,
                'height_354'    => isset($files[$i]['height'])? $files[$i]['height'] : null,
                'data_354'      => null
            ];

            $objectsResponse[] = $files[$i];
        }

        Library::insert($objects);

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

    private function getType($mime)
    {
        switch ($mime) {
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/png':
            case 'image/svg+xml':
                return [ 'id' => 1, 'type' => trans_choice('pulsar::pulsar.image', 1)];
                break;
            case 'text/plain':
            case 'application/msword':
            case 'application/x-pdf':
            case 'application/pdf':
                return [ 'id' => 2, 'type' => trans_choice('pulsar::pulsar.file', 1)];
                break;
            case 'video/avi':
            case 'video/mpeg':
            case 'video/quicktime':
            case 'video/mp4':
                return [ 'id' => 3, 'type' => trans_choice('pulsar::pulsar.video', 1)];
                break;
            default:
                return null;
        }
    }
}