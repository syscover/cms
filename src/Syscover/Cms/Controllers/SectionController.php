<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Section;

/**
 * Class SectionController
 * @package Syscover\Cms\Controllers
 */

class SectionController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsSection';
    protected $folder       = 'section';
    protected $package      = 'cms';
    protected $aColumns     = ['id_350', 'name_350', 'name_351'];
    protected $nameM        = 'name_350';
    protected $model        = Section::class;
    protected $icon         = 'sys-icon-magnet';
    protected $objectTrans  = 'section';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['families']     = ArticleFamily::all();

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        Section::create([
            'id_350'                => $request->input('id'),
            'name_350'              => $request->input('name'),
            'article_family_350'    => $request->has('family')? $request->input('family') : null
        ]);
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['families']     = ArticleFamily::all();

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        Section::where('id_350', $parameters['id'])->update([
            'id_350'                => $request->input('id'),
            'name_350'              => $request->input('name'),
            'article_family_350'    => $request->has('family')? $request->input('family') : null
        ]);
    }
}