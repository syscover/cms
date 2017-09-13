<?php namespace Syscover\Cms\Controllers;

use Syscover\Pulsar\Core\Controller;
use Syscover\Pulsar\Libraries\CustomFieldResultLibrary;
use Syscover\Pulsar\Models\AttachmentFamily;
use Syscover\Pulsar\Libraries\AttachmentLibrary;
use Syscover\Cms\Old\Models\Tag;
use Syscover\Cms\Old\Models\Category;
use Syscover\Cms\Old\Models\Section;
use Syscover\Cms\Old\Models\ArticleFamily;
use Syscover\Cms\Old\Models\Article;

/**
 * Class ArticleController
 * @package Syscover\Cms\Controllers
 */

class ArticleController extends Controller
{
    protected $routeSuffix  = 'cmsArticle';
    protected $folder       = 'article';
    protected $package      = 'cms';
    protected $indexColumns = ['id_355', 'publish_355', 'publish_text_355', 'name_001', 'name_350', 'title_355', 'sorting_355'];
    protected $nameM        = 'name_355';
    protected $model        = Article::class;
    protected $icon         = 'fa fa-file-text-o';
    protected $objectTrans  = 'article';

    public function customIndex($parameters)
    {
        $parameters['urlParameters']['lang']    = base_lang()->id_001;
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
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['tags']                 = [];
        $tags                               = Tag::builder()->where('lang_id_358', $parameters['lang']->id_001)->get();
        foreach($tags as $tag)
        {
            $parameters['tags'][] = [
                'value' => $tag->id_358,
                'label' => $tag->name_358
            ];
        }
        $parameters['categories']           = Category::builder()->where('lang_id_352', $parameters['lang']->id_001)->get();
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_id_015' => 'cms-article']);
        $parameters['attachmentsInput']     = json_encode([]);

        if(isset($parameters['id']))
        {
            // get attachments from base lang
            $attachments = AttachmentLibrary::getRecords($this->package, 'cms-article', $parameters['id'], base_lang()->id_001, true);

            // merge parameters and attachments array
            $parameters  = array_merge($parameters, $attachments);
        }

        return $parameters;
    }

    public function checkSpecialRulesToStore($parameters)
    {
        $nArticle = Article::where('lang_id_355', $this->request->input('lang'))->where('slug_355', $this->request->input('slug'))->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function storeCustomRecord($parameters)
    {
        // check if there is id
        if($this->request->has('id'))
        {
            $id     = $this->request->input('id');
            $idLang = $id;
        }
        else
        {
            $id     = Article::max('id_355');
            $id++;
            $idLang = null;
        }

        $article = Article::create([
            'id_355'            => $id,
            'lang_id_355'       => $this->request->input('lang'),
            'author_id_355'     => $this->request->input('author'),
            'section_id_355'    => $this->request->input('section'),
            'family_id_355'     => $this->request->has('family')? $this->request->input('family') : null,
            'status_id_355'     => $this->request->input('status'),
            'publish_355'       => $this->request->has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => $this->request->has('publish')?  $this->request->input('publish') : date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => $this->request->has('date')? \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('date'))->getTimestamp() : null,
            'title_355'         => $this->request->has('title')? $this->request->input('title') : null,
            'slug_355'          => $this->request->has('slug')? $this->request->input('slug') : null,
            'link_355'          => $this->request->has('link')? $this->request->input('link') : null,
            'blank_355'         => $this->request->has('blank'),
            'sorting_355'       => $this->request->has('sorting')? $this->request->input('sorting') : null,
            'article_355'       => $this->request->input('article'),
            'data_lang_355'     => Article::addLangDataRecord($this->request->input('lang'), $idLang),
            'data_355'          => null
        ]);

        // get object with builder, to get every relations
        $article = Article::builder()->where('id_355', $article->id_355)->where('lang_id_355', $article->lang_id_355)->first();

        // tags
        $tags = json_decode($this->request->input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_id_358'   => $this->request->input('lang'),
                        'name_358'      => $tag->label
                    ]);

                    $idTags[] = $tagObj->id_358;
                }
                else
                {
                    $idTags[] = $tag->value;
                }
            }

            $article->getTags()->sync($idTags);
        }

        // set categories
        if(is_array($this->request->input('categories')))
        {
            $article->getCategories()->sync($this->request->input('categories'));
        }

        // set attachments
        $attachments = json_decode($this->request->input('attachments'));
        AttachmentLibrary::storeAttachments($attachments, 'cms', 'cms-article', $id, $this->request->input('lang'));

        // set custom fields
        if($article->field_group_id_351 !== null)
            CustomFieldResultLibrary::storeCustomFieldResults($this->request, $article->field_group_id_351, 'cms-article-family', $article->id_355, $this->request->input('lang'));
    }

    public function editCustomRecord($parameters)
    {
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['tags']                 = [];
        $tags                               = Tag::builder()->where('lang_id_358', $parameters['object']->lang_id_355)->get();
        foreach($tags as $tag)
        {
            $parameters['tags'][] = [
                'value' => $tag->id_358,
                'label' => $tag->name_358
            ];
        }
        $objectTags = $parameters['object']->getTags;
        $parameters['selectTags'] = [];
        foreach($objectTags as $objectTag)
        {
            $parameters['selectTags'][] = [
                'value' => $objectTag->id_358,
                'label' => $objectTag->name_358
            ];
        }

        $parameters['categories']           = Category::builder()->where('lang_id_352', $parameters['object']->lang_id)->get();
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        // get attachments elements
        $attachments = AttachmentLibrary::getRecords('cms', 'cms-article', $parameters['object']->id_355, $parameters['object']->lang_id);

        // merge parameters and attachments array
        $parameters['attachmentFamilies']   = AttachmentFamily::getAttachmentFamilies(['resource_id_015' => 'cms-article']);
        $parameters                         = array_merge($parameters, $attachments);

        return $parameters;
    }

    public function checkSpecialRulesToUpdate($parameters)
    {
        $nArticle = Article::where('lang_id_355', $this->request->input('lang'))->where('slug_355', $this->request->input('slug'))->whereNotIn('id_355', [$parameters['id']])->count();

        if($nArticle > 0) $parameters['specialRules']['slugRule'] = true;

        return $parameters;
    }

    public function updateCustomRecord($parameters)
    {
        Article::where('id_355', $parameters['id'])->where('lang_id_355', $this->request->input('lang'))->update([
            'section_id_355'    => $this->request->input('section'),
            'family_id_355'     => $this->request->has('family')? $this->request->input('family') : null,
            'status_id_355'     => $this->request->input('status'),
            'publish_355'       => $this->request->has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', $this->request->input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => $this->request->has('publish')? $this->request->input('publish') : date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), $this->request->input('date'))->getTimestamp(),
            'title_355'         => $this->request->input('title'),
            'slug_355'          => $this->request->has('slug')? $this->request->input('slug') : null,
            'link_355'          => $this->request->has('link')? $this->request->input('link') : null,
            'blank_355'         => $this->request->has('blank'),
            'sorting_355'       => $this->request->has('sorting')? $this->request->input('sorting') : null,
            'article_355'       => $this->request->input('article'),
            'data_355'          => null
        ]);

        $article = Article::builder()->where('id_355', $parameters['id'])->where('lang_id_355', $parameters['lang'])->first();

        // tags
        $tags = json_decode($this->request->input('jsonTags'));
        if(is_array($tags) && count($tags) > 0)
        {
            $idTags = [];
            foreach ($tags as $tag)
            {
                if ($tag->value === 'null')
                {
                    $tagObj = Tag::create([
                        'lang_id_358'   => $this->request->input('lang'),
                        'name_358'      => $tag->label
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
        if(is_array($this->request->input('categories')))
        {
            $article->getCategories()->sync($this->request->input('categories'));
        }
        else
        {
            $article->getCategories()->detach();
        }

        // set custom fields
        if($article->field_group_id_351 !== null)
        {
            CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $article->id_355, $this->request->input('lang'));
            CustomFieldResultLibrary::storeCustomFieldResults($this->request, $article->field_group_id_351, 'cms-article-family', $article->id_355, $this->request->input('lang'));
        }
    }

    public function deleteCustomRecord($object)
    {
        // delete object from all language
        $object->getCategories()->detach();

        // delete all attachments
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355);
        CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $object->id_355);
    }

    public function deleteCustomTranslationRecord($object)
    {
        // delete all attachments from lang object
        AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $object->id_355, $object->lang_id_355);
        CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $object->id_355, $object->lang_id_355);
    }

    public function deleteCustomRecordsSelect($ids)
    {
        $articles = Article::getRecordsById($ids);

        foreach($articles as $article)
        {
            $article->getCategories()->detach();

            AttachmentLibrary::deleteAttachment($this->package, 'cms-article', $article->id_355);
            CustomFieldResultLibrary::deleteCustomFieldResults('cms-article-family', $article->id_355);
        }
    }

    public function apiCheckSlug()
    {
        $slug = $this->request->input('slug');
        $query = Article::where('lang_id_355', $this->request->input('lang'))
            ->where('slug_355', $slug);

        if($this->request->input('id'))
        {
            $query->whereNotIn('id_355', [$this->request->input('id')]);
        }

        $nObjects = $query->count();

        if($nObjects > 0)
        {
            $suffix = 0;
            while($nObjects > 0)
            {
                $suffix++;
                $slug = $this->request->input('slug') . '-' . $suffix;
                $nObjects = Article::where('lang_id_355', $this->request->input('lang'))
                    ->where('slug_355', $slug)
                    ->count();
            }
        }

        return response()->json([
            'status'    => 'success',
            'slug'      => $slug
        ]);
    }
}