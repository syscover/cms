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
use Syscover\Cms\Models\AttachmentFamily;
use Syscover\Cms\Models\Category;
use Syscover\Cms\Models\Section;
use Syscover\Cms\Models\ArticleFamily;
use Syscover\Cms\Models\Article;
use Syscover\Cms\Models\Attachment;

class ArticleController extends Controller {

    use TraitController;

    protected $routeSuffix  = 'CmsArticle';
    protected $folder       = 'article';
    protected $package      = 'cms';
    protected $aColumns     = ['id_355', 'publish_355', 'publish_text_355', 'name_001', 'name_350', 'title_355'];
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
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['attachmentFamilies']   = AttachmentFamily::all();
        $parameters['categories']           = Category::getTranslationsRecords($parameters['lang']);
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];
        $parameters['attachmentsInput']     = json_encode([]);

        if(isset($parameters['id']))
        {
            $parameters['attachments'] = Attachment::getTranslationsAttachmentsArticle(['lang' => session('baseLang')->id_001, 'article' => $parameters['id']]);

            foreach($parameters['attachments'] as $attachment)
            {
                File::copy(public_path() . Attachment::$folder . '/' . $attachment->file_name_357, public_path() . Attachment::$tmpFolder . '/' . $attachment->file_name_357);

                $attachmentsInput     = [];

                foreach($parameters['attachments'] as $attachment)
                {
                    $attachmentsInput[] = [
                        'id'                => $attachment->id_357,
                        'type'              => ['id' => $attachment->type_357, 'name' => $attachment->type_text_357],
                        'mime'              => $attachment->mime_357,
                        'family'            => $attachment->family_357,
                        'folder'            => Attachment::$tmpFolder,
                        'fileName'          => $attachment->file_name_357,
                        'library'           => $attachment->library_357,
                        'libraryFileName'   => $attachment->library_file_name_357,
                        'imageName'         => $attachment->name_357,
                        'sorting'           => $attachment->sorting_357,
                    ];
                }

                $parameters['attachmentsInput'] = json_encode($attachmentsInput);
            }
        }

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
            'tags_355'          => Request::input('tags'),
            'article_355'       => Request::input('article'),
            'data_355'          => Article::addLangDataRecord($id, Request::input('lang'))
        ]);

        if(is_array(Request::input('categories')))
        {
            $article->categories()->sync(Request::input('categories'));
        }

        // Attachment
        $attachments = json_decode(Request::input('attachments'));

        if(!File::exists(public_path() . Attachment::$folder . '/' . $article->id_355 . '/'. Request::input('lang')))
        {
            File::makeDirectory(public_path() . Attachment::$folder . '/' . $article->id_355 . '/'. Request::input('lang'), 0755, true);
        }

        foreach($attachments as $attachment)
        {
            $idAttachment = Attachment::max('id_357');
            $idAttachment++;

            $width = null; $height= null;
            if($attachment->type->id == 1)
            {
                list($width, $height) = getimagesize(public_path() . $attachment->folder . '/' . $attachment->fileName);
            }

            // move file fom temp file to attachment folder
            File::move(public_path() . $attachment->folder . '/' . $attachment->fileName, public_path() . Attachment::$folder . '/' . $article->id_355 . '/'. Request::input('lang') .'/' . $attachment->fileName);

            Attachment::create([
                'id_357'                => $idAttachment,
                'lang_357'              => Request::input('lang'),
                'article_357'           => $article->id_355,
                'family_357'            => $attachment->family == ""? null : $attachment->family,
                'library_357'           => $attachment->library,
                'library_file_name_357' => $attachment->libraryFileName == ""? null : $attachment->libraryFileName,
                'sorting_357'           => $attachment->sorting,
                'name_357'              => $attachment->imageName == ""? null : $attachment->imageName,
                'file_name_357'         => $attachment->fileName == ""? null : $attachment->fileName,
                'mime_357'              => $attachment->mime,
                'size_357'              => filesize(public_path() . Attachment::$folder . '/' . $article->id_355 .  '/' . Request::input('lang') . '/' . $attachment->fileName),
                'type_357'              => $attachment->type->id,
                'type_text_357'         => $attachment->type->name,
                'width_357'             => $width,
                'height_357'            => $height,
                'data_357'              => null
            ]);
        }
    }

    public function editCustomRecord($parameters)
    {
        $parameters['sections']             = Section::all();
        $parameters['families']             = ArticleFamily::all();
        $parameters['attachmentFamilies']   = AttachmentFamily::all();
        $parameters['categories']           = Category::getTranslationsRecords($parameters['lang']->id_001);
        $parameters['statuses']             = [
            (object)['id' => 0, 'name' => trans('cms::pulsar.draft')],
            (object)['id' => 1, 'name' => trans('cms::pulsar.publish')]
        ];

        $parameters['attachments']          = $parameters['object']->attachments;
        $attachmentsInput     = [];

        foreach($parameters['attachments'] as $attachment)
        {
            $attachmentsInput[] = [
                'id'                => $attachment->id_357,
                'type'              => ['id' => $attachment->type_357, 'name' => $attachment->type_text_357],
                'mime'              => $attachment->mime_357,
                'family'            => $attachment->family_357,
                'folder'            => Attachment::$folder . '/' . $attachment->article_357 . '/' . $attachment->lang_357,
                'fileName'          => $attachment->file_name_357,
                'library'           => $attachment->library_357,
                'libraryFileName'   => $attachment->library_file_name_357,
                'imageName'         => $attachment->name_357,
                'sorting'           => $attachment->sorting_357,
            ];
        }

        $parameters['attachmentsInput'] = json_encode($attachmentsInput);

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
            'section_355'       => Request::input('section'),
            'family_355'        => Request::has('family')? Request::input('family') : null,
            'status_355'        => Request::input('status'),
            'publish_355'       => Request::has('publish')? \DateTime::createFromFormat(config('pulsar.datePattern') . ' H:i', Request::input('publish'))->getTimestamp() : (integer)date('U'),
            'publish_text_355'  => Request::has('publish')? Request::input('publish') : date(config('pulsar.datePattern') . ' H:i'),
            'date_355'          => \DateTime::createFromFormat(config('pulsar.datePattern'), Request::input('date'))->getTimestamp(),
            'title_355'         => Request::input('title'),
            'slug_355'          => Request::input('slug') == "" || !Request::has('slug')? null : Request::input('slug'),
            'sorting_355'       => Request::input('sorting'),
            'tags_355'          => Request::input('tags'),
            'article_355'       => Request::input('article')
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
        $attachments = $object->attachments;

        foreach ($attachments as $attachment)
        {
            File::delete(public_path() . Attachment::$folder . '/' . $attachment->file_name_354);
        }
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