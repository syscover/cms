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

use Illuminate\Support\Facades\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\AttachmentFamily;

class AttachmentFamilyController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsAttachmentFamily';
    protected $folder       = 'attachment_family';
    protected $package      = 'cms';
    protected $aColumns     = ['id_353', 'name_353'];
    protected $nameM        = 'name_353';
    protected $model        = '\Syscover\Cms\Models\AttachmentFamily';
    protected $icon         = 'icon-picture';
    protected $objectTrans  = 'attachment-family';

    public function storeCustomRecord()
    {
        AttachmentFamily::create([
            'name_353'      => Request::input('name'),
            'width_353'     => Request::has('width')? Request::input('width') : null,
            'height_353'    => Request::has('height')? Request::input('height') : null,
            'data_353'      => null
        ]);
    }
    
    public function updateCustomRecord($parameters)
    {
        AttachmentFamily::where('id_353', $parameters['id'])->update([
            'name_353'      => Request::input('name'),
            'width_353'     => Request::has('width')? Request::input('width') : null,
            'height_353'    => Request::has('height')? Request::input('height') : null,
            'data_353'      => null
        ]);
    }
}