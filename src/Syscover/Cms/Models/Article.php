<?php namespace Syscover\Cms\Old\Models;

use Illuminate\Validation\Rule;
use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Article
 *
 * Model with properties
 * <br><b>[id, lang_id, section_id, family_id, author_id, date, publish, publish_text, status_id, title, slug, link, blank, sorting, article, data_lan, data]</b>
 *
 * @package     Syscover\Cms\Old\Models
 */

class Article extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_355_article';
    protected $primaryKey   = 'id_355';
    protected $suffix       = '355';
    public $timestamps      = false;
    public $incrementing    = false;
    protected $fillable     = ['id_355', 'lang_id_355', 'section_id_355', 'family_id_355', 'author_id_355', 'date_355', 'publish_355', 'publish_text_355', 'status_id_355', 'title_355', 'slug_355', 'link_355', 'blank_355', 'sorting_355', 'article_355', 'data_lang_355', 'data_355'];
    protected $maps         = [];
    protected $relationMaps = [
        'lang'      => \Syscover\Pulsar\Models\Lang::class,
        'author'    => \Syscover\Pulsar\Models\User::class,
        'section'   => \Syscover\Cms\Old\Models\Section::class,
        'family'    => \Syscover\Cms\Old\Models\ArticleFamily::class,
    ];
    private static $rules   = [
        'section'   => 'required',
        'status'    => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['slugRule']) && $specialRules['slugRule'])
        {
            //static::$rules['slug'] = 'unique:013_355_article,slug_355,NULL,013_355_article,lang_id_355,' . $data['lang'];
            static::$rules['slug'] =
                Rule::unique('mysql2.013_355_article', 'slug_355')
                    ->ignore($data['id'], 'id_355');
        }

        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('001_001_lang', '013_355_article.lang_id_355', '=', '001_001_lang.id_001')
            ->join('001_010_user', '013_355_article.author_id_355', '=', '001_010_user.id_010')
            ->join('013_350_section', '013_355_article.section_id_355', '=', '013_350_section.id_350')
            ->leftJoin('013_351_article_family', '013_355_article.family_id_355', '=', '013_351_article_family.id_351');
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_id_355');
    }

    public function getAuthor()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\User', 'author_id_355');
    }

    public function getFamily()
    {
        return $this->belongsTo('Syscover\Cms\Old\Models\ArticleFamily', 'family_id_355');
    }

    public function getAttachments()
    {
        return $this->hasMany('Syscover\Pulsar\Models\Attachment', 'object_id_016')
            ->where('001_016_attachment.lang_id_016', $this->lang_id_355)
            ->where('001_016_attachment.resource_id_016', 'cms-article')
            ->leftJoin('001_015_attachment_family', '001_016_attachment.family_id_016', '=', '001_015_attachment_family.id_015')
            ->orderBy('001_016_attachment.sorting_016');
    }

    public function getCategories()
    {
        return $this->belongsToMany('Syscover\Cms\Old\Models\Category', '013_356_articles_categories', 'article_id_356', 'category_id_356');
    }

    public function getTags()
    {
        return $this->belongsToMany('Syscover\Cms\Old\Models\Tag', '013_359_articles_tags', 'article_id_359', 'tag_id_359');
    }

    public function addToGetIndexRecords($request, $parameters)
    {
        $query =  $this->builder();

        if(isset($parameters['lang'])) $query->where('lang_id_355', $parameters['lang']);

        return $query;
    }

    public static function customCount($request, $parameters)
    {
        return Article::where('lang_id_355', $parameters['lang'])->getQuery();
    }

    public static function getTranslationPublishArticles($parameters)
    {
        return Article::builder()
            ->where('lang_id_355', $parameters['lang'])
            ->where('publish_355', '<' , date('U'))
            ->where('status_id_355', 1)
            ->orderBy('sorting_355')
            ->orderBy('date_355', 'desc')
            ->get();
    }
}