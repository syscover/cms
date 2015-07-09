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
use Illuminate\Http\Request as HttpRequest;
use Syscover\Cms\Models\Category;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Cms\Models\Section;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Article;

class ArticleController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticle';
    protected $folder       = 'articles';
    protected $package      = 'cms';
    protected $aColumns     = ['id_355', 'name_001', 'title_355'];
    protected $nameM        = 'name_355';
    protected $model        = '\Syscover\Cms\Models\Article';
    protected $icon         = 'icon-file-text-alt';
    protected $objectTrans  = 'article';

    public function indexCustom($parameters)
    {
        $parameters['urlParameters']['lang']    = session('baseLang');
        // init record on tap 1
        $parameters['urlParameters']['tab']     = 1;

        return $parameters;
    }

    public function customActionUrlParameters($actionUrlParameters, $parameters)
    {
        $actionUrlParameters['tab'] = 1;

        return $actionUrlParameters;
    }

    public function createCustomRecord($parameters)
    {
        $parameters['sections']     = Section::all();
        $parameters['families']     = ArticleFamily::all();
        $parameters['categories']   = Category::getTranslationsRecords($parameters['lang']);
        $parameters['statuses']     = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        return $parameters;
    }

    public function checkSpecialRulesToStore($parameters)
    {
        $nArticle = Article::where('lang_355', Request::input('lang'))->where('slug_355', Request::input('slug'))->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function storeCustomRecord()
    {
        // check if there is id
        if(Request::has('id'))
        {
            $id = Request::get('id');
        }
        else
        {
            $id = Article::max('id_355');
            $id++;
        }

        $article = Article::create([
            'id_355'        => $id,
            'lang_355'      => Request::input('lang'),
            'author_355'    => Request::input('author'),
            'section_355'   => Request::input('section'),
            'family_355'    => Request::input('family'),
            'status_355'    => Request::input('status'),
            'publish_355'   => Request::has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', Request::input('publish'))->getTimestamp() : (integer)date('U'),
            'date_355'      => \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('date'))->getTimestamp(),
            'title_355'     => Request::input('title'),
            'slug_355'      => Request::input('slug'),
            'sorting_355'   => Request::input('sorting'),
            'tags_355'      => Request::input('tags'),
            'article_355'   => Request::input('article'),
            'data_355'      => Article::addLangDataRecord($id, Request::input('lang'))
        ]);

        if(is_array(Request::input('categories')))
        {
            $article->categories()->sync(Request::input('categories'));
        }
    }

    public function editCustomRecord($parameters)
    {
        $parameters['sections']     = Section::all();
        $parameters['families']     = ArticleFamily::all();
        $parameters['categories']   = Category::getTranslationsRecords($parameters['lang']->id_001);
        $parameters['statuses']     = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $nArticle = Article::where('lang_355', Request::input('lang'))->where('slug_355', Request::input('slug'))->whereNotIn('id_355', [$parameters['id']])->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        Article::where('id_355', $parameters['id'])->where('lang_355', Request::input('lang'))->update([
            'section_355'   => Request::input('section'),
            'family_355'    => Request::input('family'),
            'status_355'    => Request::input('status'),
            'publish_355'   => Request::has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', Request::input('publish'))->getTimestamp() : (integer)date('U'),
            'date_355'      => \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('date'))->getTimestamp(),
            'title_355'     => Request::input('title'),
            'slug_355'      => Request::input('slug'),
            'sorting_355'   => Request::input('sorting'),
            'tags_355'      => Request::input('tags'),
            'article_355'   => Request::input('article'),
            'data_355'      => Article::addLangDataRecord($parameters['id'], Request::input('lang'))
        ]);

        $article = Article::getCustomTranslationRecord(['id' => $parameters['id'], 'lang' => $parameters['lang']]);

        if(is_array(Request::input('categories')))
        {
            $article->categories()->sync(Request::input('categories'));
        }
        else
        {
            $article->categories()->detach();
        }
    }

    public function deleteCustomRecord($object)
    {
        $object->categories()->detach();
    }

    public function deleteCustomRecords($ids)
    {
        $articles = Article::getRecordsById($ids);

        foreach($articles as $article)
        {
            $article->categories()->detach();
        }
    }

    public function apiCheckSlug(HttpRequest $request)
    {
        $slug = $request->input('slug');
        $query = Article::where('lang_355', $request->input('lang'))->where('slug_355', $slug)->newQuery();

        if($request->input('id'))
        {
            $query->whereNotIn('id_355', [$request->input('id')]);
        }

        $nArticles = $query->count();
        
        if($nArticles > 0)
        {
            $sufix = 0;
            while($nArticles > 0)
            {
                $sufix++;
                $slug = $request->input('slug') . '-' . $sufix;
                $nArticles = Article::where('lang_355', $request->input('lang'))->where('slug_355', $slug)->count();
            }
        }

        return response()->json([
            'status'    => 'success',
            'slug'      => $slug
        ]);
    }
}