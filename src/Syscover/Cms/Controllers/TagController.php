<?php namespace Syscover\Cms\Controllers;

use Syscover\Cms\Models\Tag;
use Syscover\Pulsar\Traits\TraitController;

/**
 * Class TagController
 * @package Syscover\Cms\Controllers
 */

class TagController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsTag';
    protected $folder       = 'tag';
    protected $package      = 'cms';
    protected $aColumns     = ['id_038', 'name_002', 'name_038'];
    protected $nameM        = 'name_038';
    protected $model        = Tag::class;
    protected $icon         = 'cut-icon-grid';
    protected $objectTrans  = 'tag';

    public function storeCustomRecord($parameters)
    {
        Tag::create([
            'name_038'      => $this->request->input('name'),
            'lang_038'      => $this->request->input('lang')
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Tag::where('id_038', $parameters['id'])->update([
            'name_038'      => $this->request->input('name')
        ]);
    }
}

