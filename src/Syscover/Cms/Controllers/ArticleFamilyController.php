<?php namespace Syscover\Cms\Controllers;

/**
 * @package	    Cms
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Models\CustomFieldGroup;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\ArticleFamily;

class ArticleFamilyController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticleFamily';
    protected $folder       = 'article_family';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351', 'name_025'];
    protected $nameM        = 'name_351';
    protected $model        = '\Syscover\Cms\Models\ArticleFamily';
    protected $icon         = 'fa fa-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($request, $parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['familiesCustomFields'] = CustomFieldGroup::getRecords(['resource_025' => 'cms-article-family']);

        return $parameters;
    }

    public function storeCustomRecord($request, $parameters)
    {
        ArticleFamily::create([
            'name_351'                  => $request->input('name'),
            'editor_type_351'           => $request->input('editor', false),
            'custom_field_group_351'    => empty($request->input('familyCustomField'))? null : $request->input('familyCustomField'),
            'data_351'                  => json_encode([
                'date'                  => $request->has('date'),
                'title'                 => $request->has('title'),
                'slug'                  => $request->has('slug'),
                'categories'            => $request->has('categories'),
                'sorting'               => $request->has('sorting'),
                'tags'                  => $request->has('tags'),
            ])
        ]);
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['editors']              = config('cms.editors');
        $parameters['familiesCustomFields'] = CustomFieldGroup::getRecords(['resource_025' => 'cms-article-family']);
        $parameters['data']                 = json_decode($parameters['object']->data_351);

        return $parameters;
    }
    
    public function updateCustomRecord($request, $parameters)
    {
        ArticleFamily::where('id_351', $parameters['id'])->update([
            'name_351'                  => $request->input('name'),
            'editor_type_351'           => $request->input('editor'),
            'custom_field_group_351'    => empty($request->input('familyCustomField'))? null : $request->input('familyCustomField'),
            'data_351'                  => json_encode([
                'date'                  => $request->has('date'),
                'title'                 => $request->has('title'),
                'slug'                  => $request->has('slug'),
                'categories'            => $request->has('categories'),
                'sorting'               => $request->has('sorting'),
                'tags'                  => $request->has('tags'),
            ])
        ]);
    }
}