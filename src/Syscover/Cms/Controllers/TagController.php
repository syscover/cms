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
use Syscover\Cms\Models\Tag;
use Syscover\Pulsar\Traits\TraitController;

class TagController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsTag';
    protected $folder       = 'tag';
    protected $package      = 'cms';
    protected $aColumns     = ['id_038', 'name_002', 'name_038'];
    protected $nameM        = 'name_038';
    protected $model        = '\Syscover\Cms\Models\Tag';
    protected $icon         = 'cut-icon-grid';
    protected $objectTrans  = 'tag';

    public function storeCustomRecord($parameters)
    {
        Tag::create([
            'name_038'      => Request::input('name'),
            'lang_038'      => Request::input('lang')
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Tag::where('id_038', $parameters['id'])->update([
            'name_038'      => Request::input('name')
        ]);
    }
}
