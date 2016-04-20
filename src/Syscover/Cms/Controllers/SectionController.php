<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Section;

/**
 * Class SectionController
 * @package Syscover\Cms\Controllers
 */

class SectionController extends Controller
{
    protected $routeSuffix  = 'cmsSection';
    protected $folder       = 'section';
    protected $package      = 'cms';
    protected $aColumns     = ['id_350', 'name_350', 'name_351'];
    protected $nameM        = 'name_350';
    protected $model        = Section::class;
    protected $icon         = 'sys-icon-magnet';
    protected $objectTrans  = 'section';

    public function createCustomRecord($parameters)
    {
        $parameters['families']     = ArticleFamily::all();

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        Section::create([
            'id_350'                => $this->request->input('id'),
            'name_350'              => $this->request->input('name'),
            'article_family_350'    => $this->request->has('family')? $this->request->input('family') : null
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
            'id_350'                => $this->request->input('id'),
            'name_350'              => $this->request->input('name'),
            'article_family_350'    => $this->request->has('family')? $this->request->input('family') : null
        ]);
    }
}