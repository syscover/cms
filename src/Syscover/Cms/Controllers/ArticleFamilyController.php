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

use Illuminate\Support\Facades\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\ArticleFamily;

class ArticleFamilyController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticleFamily';
    protected $folder       = 'article_family';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351'];
    protected $nameM        = 'name_351';
    protected $model        = '\Syscover\Cms\Models\ArticleFamily';
    protected $icon         = 'fa fa-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Wysiwyg'],
            (object)['id' => 2, 'name' => 'Contentbuilder'],
        ];

        $parameters['types'] = [
            (object)['id' => 1, 'name' => 'Text'],
            (object)['id' => 2, 'name' => 'Checkbox'],
        ];

        return $parameters;
    }

    public function storeCustomRecord()
    {
        ArticleFamily::create([
            'name_351'          => Request::input('name'),
            'editor_type_351'   => Request::input('editor', false),
            'data_351'          => json_encode([
                'date'          => Request::has('date'),
                'title'         => Request::has('title'),
                'slug'          => Request::has('slug'),
                'categories'    => Request::has('categories'),
                'sorting'       => Request::has('sorting'),
                'tags'          => Request::has('tags'),
                'customFields'  => json_decode(Request::input('fieldsData'))
            ])
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Wysiwyg'],
            (object)['id' => 2, 'name' => 'Contentbuilder']
        ];

        $parameters['types'] = [
            (object)['id' => 1, 'name' => 'Text'],
            (object)['id' => 2, 'name' => 'Checkbox'],
        ];

        $parameters['data']         = json_decode($parameters['object']->data_351);
        $parameters['customFields'] = json_encode($parameters['data']->customFields);

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        ArticleFamily::where('id_351', $parameters['id'])->update([
            'name_351'          => Request::input('name'),
            'editor_type_351'   => Request::input('editor'),
            'data_351'          => json_encode([
                'date'          => Request::has('date'),
                'title'         => Request::has('title'),
                'slug'          => Request::has('slug'),
                'categories'    => Request::has('categories'),
                'sorting'       => Request::has('sorting'),
                'tags'          => Request::has('tags'),
                'customFields'  => json_decode(Request::input('fieldsData'))
            ])
        ]);
    }
}