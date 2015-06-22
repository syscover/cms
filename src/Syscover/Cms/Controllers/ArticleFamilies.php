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
use Syscover\Pulsar\Traits\ControllerTrait;
use Syscover\Cms\Models\ArticleFamily;

class ArticleFamilies extends Controller {

    use ControllerTrait;

    protected $routeSuffix  = 'CmsArticleFamilies';
    protected $folder       = 'article_families';
    protected $package      = 'cms';
    protected $aColumns     = ['id_351', 'name_351', 'image_width_351', 'image_height_351'];
    protected $nameM        = 'name_351';
    protected $model        = '\Syscover\Cms\Models\ArticleFamily';
    protected $icon         = 'icon-align-justify';
    protected $objectTrans  = 'article_family';

    public function createCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Text'],
            (object)['id' => 2, 'name' => 'Wysiwyg'],
            (object)['id' => 3, 'name' => 'Contentbuilder']
        ];

        return $parameters;
    }

    public function storeCustomRecord()
    {
        ArticleFamily::create([
            'name_351'          => Request::input('name'),
            'image_width_351'   => Request::input('width'),
            'image_height_351'  => Request::input('height'),
            'editor_type_351'   => Request::input('editor')
        ]);
    }

    public function editCustomRecord($parameters)
    {
        $parameters['editors'] = [
            (object)['id' => 1, 'name' => 'Text'],
            (object)['id' => 2, 'name' => 'Wysiwyg'],
            (object)['id' => 3, 'name' => 'Contentbuilder']
        ];

        return $parameters;
    }
    
    public function updateCustomRecord($parameters)
    {
        ArticleFamily::where('id_351', $parameters['id'])->update([
            'name_351'          => Request::input('name'),
            'image_width_351'   => Request::input('width'),
            'image_height_351'  => Request::input('height'),
            'editor_type_351'   => Request::input('editor')
        ]);
    }
}