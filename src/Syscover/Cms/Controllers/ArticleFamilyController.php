<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Pulsar\Models\CustomFieldGroup;
use Syscover\Cms\Models\ArticleFamily;

/**
 * Class ArticleFamilyController
 * @package Syscover\Cms\Controllers
 */

class ArticleFamilyController extends Controller
{
    protected $routeSuffix  = 'cmsArticleFamily';
    protected $folder       = 'article_family';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351', 'name_025'];
    protected $nameM        = 'name_351';
    protected $model        = ArticleFamily::class;
    protected $icon         = 'fa fa-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['customFieldGroups']    = CustomFieldGroup::builder()->where('resource_id_025', 'cms-article-family')->get();

        return $parameters;
    }

    // todo implementar columnas en la base de datos
    public function storeCustomRecord($parameters)
    {
        ArticleFamily::create([
            'name_351'                  => $this->request->input('name'),
            'editor_id_351'             => $this->request->input('editor', false),
            'field_group_id_351'        => $this->request->has('customFieldGroup')? $this->request->input('customFieldGroup') : null,
            'data_351'                  => json_encode([
                'date'                  => $this->request->has('date'),
                'title'                 => $this->request->has('title'),
                'slug'                  => $this->request->has('slug'),
                'link'                  => $this->request->has('link'),
                'categories'            => $this->request->has('categories'),
                'sorting'               => $this->request->has('sorting'),
                'tags'                  => $this->request->has('tags'),
            ])
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['customFieldGroups']    = CustomFieldGroup::builder()->where('resource_id_025', 'cms-article-family')->get();
        $parameters['data']                 = json_decode($parameters['object']->data_351);

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        ArticleFamily::where('id_351', $parameters['id'])->update([
            'name_351'                  => $this->request->input('name'),
            'editor_id_351'             => $this->request->input('editor'),
            'field_group_id_351'        => $this->request->has('customFieldGroup')? $this->request->input('customFieldGroup') : null,
            'data_351'                  => json_encode([
                'date'                  => $this->request->has('date'),
                'title'                 => $this->request->has('title'),
                'slug'                  => $this->request->has('slug'),
                'link'                  => $this->request->has('link'),
                'categories'            => $this->request->has('categories'),
                'sorting'               => $this->request->has('sorting'),
                'tags'                  => $this->request->has('tags'),
            ])
        ]);
    }
}