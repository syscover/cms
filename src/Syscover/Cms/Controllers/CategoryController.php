<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\Category;

/**
 * Class CategoryController
 * @package Syscover\Cms\Controllers
 */

class CategoryController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsCategory';
    protected $folder       = 'category';
    protected $package      = 'cms';
    protected $aColumns     = ['id_352', 'name_001', 'name_352'];
    protected $nameM        = 'name_352';
    protected $model        = \Syscover\Cms\Models\Category::class;
    protected $icon         = 'fa fa-list-ol';
    protected $objectTrans  = 'category';

    public function indexCustom($parameters)
    {
        $parameters['urlParameters']['lang']    = session('baseLang');

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        // check if there is id
        if($request->has('id'))
        {
            $id = $request->input('id');
            $idLang = $id;
        }
        else
        {
            $id = Category::max('id_352');
            $id++;
            $idLang = null;
        }

        Category::create([
            'id_352'        => $id,
            'lang_352'      => $request->input('lang'),
            'name_352'      => $request->input('name'),
            'sorting_352'   => $request->has('sorting')? $request->input('sorting') : null,
            'data_lang_352' => Category::addLangDataRecord($request->input('lang'), $idLang)
        ]);
    }

    public function updateCustomRecord($request, $parameters)
    {
        Category::where('id_352', $parameters['id'])->where('lang_352', $request->input('lang'))->update([
            'name_352'      => $request->input('name'),
            'sorting_352'   => $request->has('sorting')? $request->input('sorting') : null,
        ]);
    }
}