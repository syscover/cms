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
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Section;

class Sections extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsSection';
    protected $folder       = 'sections';
    protected $package      = 'cms';
    protected $aColumns     = ['id_350', 'name_350', 'name_351'];
    protected $nameM        = 'name_350';
    protected $model        = '\Syscover\Cms\Models\Section';
    protected $icon         = 'sys-icon-magnet';
    protected $objectTrans  = 'section';

    public function createCustomRecord($parameters)
    {
        $parameters['families']     = ArticleFamily::all();

        return $parameters;
    }

    public function storeCustomRecord()
    {
        Section::create([
            'id_350'                => Request::input('id'),
            'name_350'              => Request::input('name'),
            'article_family_350'    => Request::has('family')? Request::input('family') : null
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['families']     = ArticleFamily::all();

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        Section::where('id_350', $parameters['id'])->update([
            'id_350'                => Request::input('id'),
            'name_350'              => Request::input('name'),
            'article_family_350'    => Request::has('family')? Request::input('family') : null
        ]);
    }
}