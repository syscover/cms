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
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;
use Syscover\Pulsar\Controllers\Controller;
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
            $attachments = AttachmentLibrary::getAttachments($this->package, 'cms-article', $parameters['id'], session('baseLang')->id_001, true);

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
            'id_355'            => $id,
            'lang_355'          => Request::input('lang'),
            'author_355'        => Request::input('author'),
            'section_355'       => Request::input('section'),
            'family_355'        => Request::has('family')? Request::input('family') : null,
            'status_355'        => Request::input('status'),
            'publish_355'       => Request::has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', Request::input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => Request::has('publish')?  Request::input('publish'): date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('date'))->getTimestamp(),
            'title_355'         => Request::input('title'),
            'slug_355'          => Request::input('slug') == "" || !Request::has('slug')? null : Request::input('slug'),
            'sorting_355'       => Request::input('sorting'),
            'article_355'       => Request::input('article'),
            'data_lang_355'     => Article::addLangDataRecord($id, Request::input('lang')),
            'data_355'          => json_encode($this->getCustomFields())
        ]);

        // tags
        $tags = json_decode(Request::input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_358' => Request::input('lang'),
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
        if(is_array(Request::input('categories')))
        {
            $article->categories()->sync(Request::input('categories'));
        }

        // set attachments
        $attachments = json_decode(Request::input('attachments'));

        AttachmentLibrary::storeAttachments($attachments, 'cms', 'cms-article', $id, Request::input('lang'));
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
        $attachments = AttachmentLibrary::getAttachments('cms', 'cms-article', $parameters['object']->id_355, $parameters['lang']->id_001);

        // merge parameters and attachments array
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_015' => 'cms-article']);
        $parameters                         = array_merge($parameters, $attachments);

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($request, $parameters)
    {
        $nArticle = Article::where('lang_355', Request::input('lang'))->where('slug_355', Request::input('slug'))->whereNotIn('id_355', [$parameters['id']])->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function updateCustomRecord($request, $parameters)
    {
        Article::where('id_355', $parameters['id'])->where('lang_355', Request::input('lang'))->update([
            'section_355'       => Request::input('section'),
            'family_355'        => Request::has('family')? Request::input('family') : null,
            'status_355'        => Request::input('status'),
            'publish_355'       => Request::has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', Request::input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => Request::has('publish')? Request::input('publish') : date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('date'))->getTimestamp(),
            'title_355'         => Request::input('title'),
            'slug_355'          => Request::input('slug') == "" || !Request::has('slug')? null : Request::input('slug'),
            'sorting_355'       => Request::input('sorting'),
            'article_355'       => Request::input('article'),
            'data_355'          => json_encode($this->getCustomFields())
        ]);

        $article = Article::getCustomTranslationRecord(['id' => $parameters['id'], 'lang' => $parameters['lang']]);

        // tags
        $tags = json_decode(Request::input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_358' => Request::input('lang'),
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
        if(is_array(Request::input('categories')))
        {
            $article->categories()->sync(Request::input('categories'));
        }
        else
        {
            $article->categories()->detach();
        }
    }

    public function deleteCustomRecord($request, $object)
    {
        // delete object from all language
        $object->categories()->detach();

        // delete all attachments
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355);
    }

    public function deleteCustomTranslationRecord($request, $object)
    {
        // delete all attachments from lang object
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355, $object->lang_355);
    }

    public function deleteCustomRecords($request, $ids)
    {
        $articles = Article::getRecordsById($ids);

        foreach($articles as $article)
        {
            $article->categories()->detach();

            AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $article->id_355);
        }
    }

    public function apiCheckSlug(HttpRequest $request)
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

    public function apiGetCustomFields(HttpRequest $request)
    {
        $customFields = $request->input('customFields');

        $html = '';
        if(is_array($customFields))
        {
            foreach($customFields as $customField)
            {
                if($customField['type'] == 'pulsar::includes.html.form_text_group')
                {
                    $html .= view($customField['type'], ['label' => $customField['label'], 'name' => $customField['name'],  'value' => null, 'fieldSize' => $customField['size']])->render();
                }
                elseif($customField['type'] == 'pulsar::includes.html.form_checkbox_group')
                {
                    $html .= view($customField['type'], ['label' => $customField['label'], 'name' => $customField['name'],  'value' => 1, 'fieldSize' => $customField['size']])->render();
                }
            }
        }

        return response()->json([
            'status'    => 'success',
            'html'      => $html
        ]);
    }

    private function getCustomFields()
    {
        // check if has family to get custom fields
        $customFields['customFields'] = [];
        if(Request::has('family'))
        {
            $articleFamily      = ArticleFamily::find(Request::input('family'));
            $dataArticleFamily  = json_decode($articleFamily->data_351);

            foreach($dataArticleFamily->customFields as $customField)
            {
                // to text
                if($customField->type == "pulsar::includes.html.form_text_group")
                {
                    $customField->value = Request::input($customField->name);
                }
                // to checkbox
                if($customField->type == "pulsar::includes.html.form_checkbox_group")
                {
                    $customField->value = Request::has($customField->name);
                }

                $customFields['customFields'][] = $customField;
            }
        }

        return $customFields;
    }
}