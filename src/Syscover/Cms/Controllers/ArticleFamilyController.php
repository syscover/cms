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

class ArticleFamilyController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticleFamily';
    protected $folder       = 'article_families';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351'];
    protected $nameM        = 'name_351';
    protected $model        = '\Syscover\Cms\Models\ArticleFamily';
    protected $icon         = 'icon-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Wysiwyg'],
            (object)['id' => 2, 'name' => 'Contentbuilder'],
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
                'tags'          => Request::has('tags')
            ])
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Wysiwyg'],
            (object)['id' => 2, 'name' => 'Contentbuilder']
        ];

        $parameters['data'] = json_decode($parameters['object']->data_351);

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
                'tags'          => Request::has('tags')
            ])
        ]);
    }
}