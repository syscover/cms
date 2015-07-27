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

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request as HttpRequest;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\Library;

class LibraryController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsLibrary';
    protected $folder       = 'library';
    protected $package      = 'cms';
    protected $aColumns     = ['id_354', ['type' => 'library_img', 'data' => 'file_name_354'], 'file_name_354', ['type' => 'size', 'data' => 'size_354'], 'mime_354', 'type_text_354'];
    protected $nameM        = 'file_354';
    protected $model        = '\Syscover\Cms\Models\Library';
    protected $icon         = 'icon-book';
    protected $objectTrans  = 'library';

    public function customColumnType($row, $aColumn, $aObject, $request)
    {
        switch ($aColumn['type'])
        {
            case 'library_img':
                if($aObject['type_354'] == 1)
                {
                    $row[] = '<img src="' . asset(config('cms.libraryFolder') . '/' . $aObject['file_name_354']) . '" style="max-width: 100px; max-height: 50px">';
                }
                else
                {
                    $data = json_decode($aObject['data_354']);
                    $row[] = '<img src="' . asset(config('cms.iconsFolder') . '/' . $data->icon) . '" style="max-width: 100px; max-height: 50px">';
                }

                break;
            case 'size':
                $row[] = number_format($aObject['size_354'] / 1048576, 2) . ' Mb';
                break;
        }

        return $row;
    }


    public function storeLibrary(HttpRequest $request)
    {
        $parameters         = $request->route()->parameters();
        $files              = $request->input('files');
        $objects            = [];
        $objectsResponse    = [];
        $filesNames         = [];

        foreach($files as $file)
        {
            File::copy(public_path() . config('cms.libraryFolder') . '/' . $file['name'], public_path() . config('cms.tmpFolder') . '/' . $file['name']);

            $width = null; $height= null;
            if($file['isImage'] == 'true')
            {
                list($width, $height) = getimagesize(public_path() . config('cms.libraryFolder') . '/' . $file['name']);
            }

            $type = $this->getType($file['mime']);

            $objects[] = [
                'file_name_354' => $file['name'],
                'mime_354'      => $file['mime'],
                'size_354'      => $file['size'],
                'type_354'      => $type['id'],
                'type_text_354' => $type['name'],
                'width_354'     => $width,
                'height_354'    => $height,
                'data_354'      => json_encode(['icon' => $type['icon']])
            ];

            if($file['name'] != null && $file['name'] != "")
            {
                $filesNames[] = $file['name'];
            }

            // convert format getFile to format cms application
            $objectsResponse[] = [
                'id'        => null,
                'family'    => null,
                'type'      => $type,
                'mime'      => $file['mime'],
                'name'      => null,
                'folder'    => config('cms.tmpFolder'),
                'fileName'  => $file['name'],
                'width'     => $width,
                'height'    => $height
            ];
        }

        Library::insert($objects);

        $lastLibraryInsert = Library::whereIn('file_name_354', $filesNames)->get();

        foreach($lastLibraryInsert as $library)
        {
            foreach($objectsResponse as &$objectResponse)
            {
                if($library->file_name_354 == $objectResponse['fileName'])
                {
                    $objectResponse['library']          = $library->id_354;
                    $objectResponse['libraryFileName']  = $library->file_name_354;
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
                return [ 'id' => 1, 'name' => trans_choice('pulsar::pulsar.image', 1), 'icon' => 'icon_Generic.png'];
                break;
            case 'text/plain':
            case 'application/msword':
                return [ 'id' => 2, 'name' => trans_choice('pulsar::pulsar.file', 1), 'icon' => 'icon_DOCX.png'];
                break;
            case 'application/x-pdf':
            case 'application/pdf':
                return [ 'id' => 2, 'name' => trans_choice('pulsar::pulsar.file', 1), 'icon' => 'icon_PDF.png'];
                break;
            case 'video/avi':
            case 'video/mpeg':
            case 'video/quicktime':
            case 'video/mp4':
                return [ 'id' => 3, 'name' => trans_choice('pulsar::pulsar.video', 1), 'icon' => 'icon_Generic.png'];
                break;
            default:
                return null;
        }
    }
}