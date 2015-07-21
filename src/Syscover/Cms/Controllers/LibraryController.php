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
        $filesNames         = [];

        foreach($files as &$file)
        {
            if($file['isImage'] == 'true')
            {
                list($file['width'], $file['height']) = getimagesize($path . '/' . $file['name']);
            }

            $file['type'] = $this->getType($file['mime']);

            $objects[] = [
                'file_name_354' => $file['name'],
                'mime_354'      => $file['mime'],
                'size_354'      => $file['size'],
                'type_354'      => $file['type']['id'],
                'type_text_354' => $file['type']['name'],
                'width_354'     => isset($file['width'])? $file['width'] : null,
                'height_354'    => isset($file['height'])? $file['height'] : null,
                'data_354'      => null
            ];

            if($file['name'] != null && $file['name'] != "")
            {
                $filesNames[] = $file['name'];
            }

            $objectsResponse[] = $file;
        }

        Library::insert($objects);

        $lastLibraryInsert = Library::whereIn('file_name_354', $filesNames)->get();

        foreach($lastLibraryInsert as $library)
        {
            foreach($objectsResponse as &$objectResponse)
            {
                if($library->file_name_354 == $objectResponse['name'])
                {
                    $objectResponse['library'] = $library->id_354;
                }
            }
        }

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
                return [ 'id' => 1, 'name' => trans_choice('pulsar::pulsar.image', 1)];
                break;
            case 'text/plain':
            case 'application/msword':
            case 'application/x-pdf':
            case 'application/pdf':
                return [ 'id' => 2, 'name' => trans_choice('pulsar::pulsar.file', 1)];
                break;
            case 'video/avi':
            case 'video/mpeg':
            case 'video/quicktime':
            case 'video/mp4':
                return [ 'id' => 3, 'name' => trans_choice('pulsar::pulsar.video', 1)];
                break;
            default:
                return null;
        }
    }
}