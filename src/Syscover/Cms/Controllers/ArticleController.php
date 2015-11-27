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

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Syscover\Pulsar\Controllers\Controller;
use Syscover\Pulsar\Libraries\CustomFieldResultLibrary;
use Syscover\Pulsar\Traits\TraitController;
use Syscover\Pulsar\Models\AttachmentFamily;
use Syscover\Pulsar\Libraries\AttachmentLibrary;
use Syscover\Cms\Models\Tag;
use Syscover\Cms\Models\Category;
use Syscover\Cms\Models\Section;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Article;


class ArticleController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticle';
    protected $folder       = 'article';
    protected $package      = 'cms';
    protected $aColumns     = ['id_355', 'publish_355', 'publish_text_355', 'name_001', 'name_350', 'title_355'];
    protected $nameM        = 'name_355';
    protected $model        = '\Syscover\Cms\Models\Article';
    protected $icon         = 'fa fa-file-text-o';
    protected $objectTrans  = 'article';

    public function indexCustom($parameters)
    {
        $parameters['urlParameters']['lang']    = session('baseLang')->id_001;
        // init record on tap 1
        $parameters['urlParameters']['tab']     = 1;

        return $parameters;
    }

    public function customActionUrlParameters($actionUrlParameters, $parameters)
    {
        $actionUrlParameters['tab'] = 1;

        return $actionUrlParameters;
    }

    public function createCustomRecord($request, $parameters)
    {
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['tags']                 = [];
        $tags                               = Tag::getTranslationsRecords($parameters['lang']);
        foreach($tags as $tag)
        {
            $parameters['tags'][] = [
                'value' => $tag->id_358,
                'label' => $tag->name_358
            ];
        }
        $parameters['categories']           = Category::getTranslationsRecords($parameters['lang']);
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_015' => 'cms-article']);
        $parameters['attachmentsInput']     = json_encode([]);

        if(isset($parameters['id']))
        {
            // get attachments from base lang
            $attachments = AttachmentLibrary::getRecords($this->package, 'cms-article', $parameters['id'], session('baseLang')->id_001, true);

            // merge parameters and attachments array
            $parameters  = array_merge($parameters, $attachments);
        }

        return $parameters;
    }

    public function checkSpecialRulesToStore($request, $parameters)
    {
        $nArticle = Article::where('lang_355', $request->input('lang'))->where('slug_355', $request->input('slug'))->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

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
            $id = Article::max('id_355');
            $id++;
            $idLang = null;
        }

        $article = Article::create([
            'id_355'            => $id,
            'lang_355'          => $request->input('lang'),
            'author_355'        => $request->input('author'),
            'section_355'       => $request->input('section'),
            'family_355'        => $request->has('family')? $request->input('family') : null,
            'status_355'        => $request->input('status'),
            'publish_355'       => $request->has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => $request->has('publish')?  $request->input('publish'): date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('date'))->getTimestamp(),
            'title_355'         => $request->input('title'),
            'slug_355'          => $request->input('slug') == "" || !$request->has('slug')? null : $request->input('slug'),
            'sorting_355'       => $request->input('sorting'),
            'article_355'       => $request->input('article'),
            'data_lang_355'     => Article::addLangDataRecord($request->input('lang'), $idLang),
            'data_355'          => null
        ]);

        // tags
        $tags = json_decode($request->input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_358' => $request->input('lang'),
                        'name_358' => $tag->label
                    ]);

                    $idTags[] = $tagObj->id_358;
                }
                else
                {
                    $idTags[] = $tag->value;
                }
            }

            $article->tags()->sync($idTags);
        }

        // set categories
        if(is_array($request->input('categories')))
        {
            $article->categories()->sync($request->input('categories'));
        }

        // set attachments
        $attachments = json_decode($request->input('attachments'));

        AttachmentLibrary::storeAttachments($attachments, 'cms', 'cms-article', $id, $request->input('lang'));

        // set custom fields
        CustomFieldResultLibrary::storeCustomFieldResults($request, $article->family->custom_field_group_351, 'cms-article-family', $article->id_355, $request->input('lang'));
    }

    public function editCustomRecord($request, $parameters)
    {
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['tags']                 = [];
        $tags                               = Tag::getTranslationsRecords($parameters['lang']->id_001);
        foreach($tags as $tag)
        {
            $parameters['tags'][] = [
                'value' => $tag->id_358,
                'label' => $tag->name_358
            ];
        }
        $objectTags = $parameters['object']->tags;
        $parameters['selectTags'] = [];
        foreach($objectTags as $objectTag)
        {
            $parameters['selectTags'][] = [
                'value' => $objectTag->id_358,
                'label' => $objectTag->name_358
            ];
        }

        $parameters['categories']           = Category::getTranslationsRecords($parameters['lang']->id_001);
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        // get attachments elements
        $attachments = AttachmentLibrary::getRecords('cms', 'cms-article', $parameters['object']->id_355, $parameters['lang']->id_001);

        // merge parameters and attachments array
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_015' => 'cms-article']);
        $parameters                         = array_merge($parameters, $attachments);

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($request, $parameters)
    {
        $nArticle = Article::where('lang_355', $request->input('lang'))->where('slug_355', $request->input('slug'))->whereNotIn('id_355', [$parameters['id']])->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function updateCustomRecord($request, $parameters)
    {
        Article::where('id_355', $parameters['id'])->where('lang_355', $request->input('lang'))->update([
            'section_355'       => $request->input('section'),
            'family_355'        => $request->has('family')? $request->input('family') : null,
            'status_355'        => $request->input('status'),
            'publish_355'       => $request->has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $request->input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => $request->has('publish')? $request->input('publish') : date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), $request->input('date'))->getTimestamp(),
            'title_355'         => $request->input('title'),
            'slug_355'          => $request->input('slug') == "" || !$request->has('slug')? null : $request->input('slug'),
            'sorting_355'       => $request->input('sorting'),
            'article_355'       => $request->input('article'),
            'data_355'          => null
        ]);

        $article = Article::getTranslationRecord(['id' => $parameters['id'], 'lang' => $parameters['lang']]);

        // tags
        $tags = json_decode($request->input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_358' => $request->input('lang'),
                        'name_358' => $tag->label
                    ]);

                    $idTags[] = $tagObj->id_358;
                }
                else
                {
                    $idTags[] = $tag->value;
                }
            }

            $article->tags()->sync($idTags);
        }

        // categories
        if(is_array($request->input('categories')))
        {
            $article->categories()->sync($request->input('categories'));
        }
        else
        {
            $article->categories()->detach();
        }

        // set custom fields
        CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $article->id_355, $request->input('lang'));
        CustomFieldResultLibrary::storeCustomFieldResults($request, $article->family->custom_field_group_351, 'cms-article-family', $article->id_355, $request->input('lang'));
    }

    public function addToDeleteRecord($request, $object)
    {
        // delete object from all language
        $object->categories()->detach();

        // delete all attachments
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355);
        CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $object->id_355);
    }

    public function addToDeleteTranslationRecord($request, $object)
    {
        // delete all attachments from lang object
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355, $object->lang_355);
        CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $object->id_355, $object->lang_355);
    }

    public function addToDeleteRecordsSelect($request, $ids)
    {
        $articles = Article::getRecordsById($ids);

        foreach($articles as $article)
        {
            $article->categories()->detach();

            AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $article->id_355);
            CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $article->id_355);
        }
    }

    public function apiCheckSlug(Request $request)
    {
        $slug = $request->input('slug');
        $query = Article::where('lang_355', $request->input('lang'))
            ->where('slug_355', $slug)
            ->newQuery();

        if($request->input('id'))
        {
            $query->whereNotIn('id_355', [$request->input('id')]);
        }

        $nObjects = $query->count();

        if($nObjects > 0)
        {
            $sufix = 0;
            while($nObjects > 0)
            {
                $sufix++;
                $slug = $request->input('slug') . '-' . $sufix;
                $nObjects = Article::where('lang_355', $request->input('lang'))
                    ->where('slug_355', $slug)
                    ->count();
            }
        }

        return response()->json([
            'status'    => 'success',
            'slug'      => $slug
        ]);
    }

    public function apiGetCustomFields(Request $request)
    {
        return CustomFieldResultLibrary::apiGetCustomFields($request);
    }
}