<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Cms\Models\Category;

/**
 * Class CategoryController
 * @package Syscover\Cms\Controllers
 */

class CategoryController extends Controller
{
    protected $routeSuffix  = 'cmsCategory';
    protected $folder       = 'category';
    protected $package      = 'cms';
    protected $indexColumns = ['id_352', 'name_001', 'name_352'];
    protected $nameM        = 'name_352';
    protected $model        = Category::class;
    protected $icon         = 'fa fa-list-ol';
    protected $objectTrans  = 'category';

    public function customIndex($parameters)
    {
        $parameters['urlParameters']['lang'] = base_lang()->id_001;

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        // check if there is id
        if($this->request->has('id'))
        {
            $id = $this->request->input('id');
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
            'lang_id_352'   => $this->request->input('lang'),
            'name_352'      => $this->request->input('name'),
            'slug_352'      => $this->request->input('slug'),
            'sorting_352'   => $this->request->has('sorting')? $this->request->input('sorting') : null,
            'data_lang_352' => Category::addLangDataRecord($this->request->input('lang'), $idLang)
        ]);
    }

    public function updateCustomRecord($parameters)
    {
        Category::where('id_352', $parameters['id'])->where('lang_id_352', $this->request->input('lang'))->update([
            'name_352'      => $this->request->input('name'),
            'slug_352'      => $this->request->input('slug'),
            'sorting_352'   => $this->request->has('sorting')? $this->request->input('sorting') : null,
        ]);
    }

    public function apiCheckSlug()
    {
        $slug = $this->request->input('slug');
        $query = Category::where('lang_id_352', $this->request->input('lang'))
            ->where('slug_352', $slug);

        if($this->request->input('id'))
        {
            $query->whereNotIn('id_352', [$this->request->input('id')]);
        }

        $nObjects = $query->count();

        if($nObjects > 0)
        {
            $suffix = 0;
            while($nObjects > 0)
            {
                $suffix++;
                $slug = $this->request->input('slug') . '-' . $suffix;
                $nObjects = Category::where('lang_id_352', $this->request->input('lang'))
                    ->where('slug_352', $slug)
                    ->count();
            }
        }

        return response()->json([
            'status'    => 'success',
            'slug'      => $slug
        ]);
    }
}