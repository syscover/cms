<?php namespace Syscover\Cms\Controllers;

/**
 * @package	    Pulsar
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\ControllerTrait;
use Syscover\Cms\Models\Category;

class Articles extends Controller {

    use ControllerTrait;

    protected $routeSuffix  = 'CmsCategories';
    protected $folder       = 'categories';
    protected $package      = 'cms';
    protected $aColumns     = ['id_352', 'name_001', 'name_352'];
    protected $nameM        = 'name_352';
    protected $model        = '\Syscover\Cms\Models\Category';
    protected $icon         = 'icon-list-ol';
    protected $objectTrans  = 'category';

    public function indexCustom($parameters)
    {
        $parameters['urlParameters']['lang']    = Session::get('baseLang');

        return $parameters;
    }

    public function storeCustomRecord()
    {
        // check if there is id
        if(Request::has('id'))
        {
            $id = Request::get('id');
        }
        else
        {
            $id = Category::max('id_352');
            $id++;
        }

        Category::create([
            'id_352'        => $id,
            'lang_352'      => Request::input('lang'),
            'name_352'      => Request::input('name'),
            'sorting_352'   => Request::input('sorting', null),
            'data_352'      => Category::addLangDataRecord($id, Request::input('lang'))
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Category::where('id_352', $parameters['id'])->where('lang_352', Request::input('lang'))->update([
            'name_352'      => Request::input('name'),
            'sorting_352'   => Request::input('sorting', null)
        ]);
    }
}