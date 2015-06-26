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

use Illuminate\Support\Facades\Request;
use Syscover\Cms\Models\Section;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\ControllerTrait;
use Syscover\Cms\Models\Article;

class Articles extends Controller {

    use ControllerTrait;

    protected $routeSuffix  = 'CmsArticles';
    protected $folder       = 'articles';
    protected $package      = 'cms';
    protected $aColumns     = ['id_355', 'name_001', 'title_355'];
    protected $nameM        = 'name_355';
    protected $model        = '\Syscover\Cms\Models\Article';
    protected $icon         = 'icon-file-text-alt';
    protected $objectTrans  = 'article';

    public function indexCustom($parameters)
    {
        $parameters['urlParameters']['lang']    = session('baseLang');

        return $parameters;
    }

    public function createCustomRecord($parameters)
    {
        $parameters['sections'] = Section::all();

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

        Article::create([
            'id_352'        => $id,
            'lang_352'      => Request::input('lang'),
            'name_352'      => Request::input('name'),
            'sorting_352'   => Request::input('sorting', null),
            'data_352'      => Category::addLangDataRecord($id, Request::input('lang'))
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Article::where('id_352', $parameters['id'])->where('lang_352', Request::input('lang'))->update([
            'name_352'      => Request::input('name'),
            'sorting_352'   => Request::input('sorting', null)
        ]);
    }
}