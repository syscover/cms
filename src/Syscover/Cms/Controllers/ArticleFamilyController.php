<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Models\CustomFieldGroup;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\ArticleFamily;

/**
 * Class ArticleFamilyController
 * @package Syscover\Cms\Controllers
 */

class ArticleFamilyController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticleFamily';
    protected $folder       = 'article_family';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351', 'name_025'];
    protected $nameM        = 'name_351';
    protected $model        = ArticleFamily::class;
    protected $icon         = 'fa fa-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['customFieldGroups']    = CustomFieldGroup::builder()->where('resource_025', 'cms-article-family')->get();

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        ArticleFamily::create([
            'name_351'                  => $request->input('name'),
            'editor_type_351'           => $request->input('editor', false),
            'custom_field_group_351'    => empty($request->input('customFieldGroup'))? null : $request->input('customFieldGroup'),
            'data_351'                  => json_encode([
                'date'                  => $request->has('date'),
                'title'                 => $request->has('title'),
                'slug'                  => $request->has('slug'),
                'link'                  => $request->has('link'),
                'categories'            => $request->has('categories'),
                'sorting'               => $request->has('sorting'),
                'tags'                  => $request->has('tags'),
            ])
        ]);
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['customFieldGroups']    = CustomFieldGroup::builder()->where('resource_025', 'cms-article-family')->get();
        $parameters['data']                 = json_decode($parameters['object']->data_351);

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        ArticleFamily::where('id_351', $parameters['id'])->update([
            'name_351'                  => $request->input('name'),
            'editor_type_351'           => $request->input('editor'),
            'custom_field_group_351'    => empty($request->input('customFieldGroup'))? null : $request->input('customFieldGroup'),
            'data_351'                  => json_encode([
                'date'                  => $request->has('date'),
                'title'                 => $request->has('title'),
                'slug'                  => $request->has('slug'),
                'link'                  => $request->has('link'),
                'categories'            => $request->has('categories'),
                'sorting'               => $request->has('sorting'),
                'tags'                  => $request->has('tags'),
            ])
        ]);
    }
}