<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class Article
 *
 * Model with properties
 * <br><b>[id, lang, section, family, author, date, publish, publish_text, status, title, slug, sorting, article, data_lan, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Article extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_355_article';
    protected $primaryKey   = 'id_355';
    protected $suffix       = '355';
    public $timestamps      = false;
    public $incrementing    = false;
    protected $fillable     = ['id_355', 'lang_355', 'section_355', 'family_355', 'author_355', 'date_355', 'publish_355', 'publish_text_355', 'status_355', 'title_355', 'slug_355', 'sorting_355', 'article_355', 'data_lang_355', 'data_355'];
    protected $maps         = [];
    protected $relationMaps = [
        'lang'      => \Syscover\Pulsar\Models\Lang::class,
        'author'    => \Syscover\Pulsar\Models\User::class,
        'section'   => \Syscover\Cms\Models\Section::class,
        'family'    => \Syscover\Cms\Models\ArticleFamily::class,
    ];
    private static $rules   = [
        'title'     => 'between:2,510',
        'section'   => 'required',
        'status'    => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['slugRule']) && $specialRules['slugRule']) static::$rules['slug'] = 'unique:013_355_article,slug_355,NULL,013_355_article,lang_355,' . $data['lang'];

        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('001_001_lang', '013_355_article.lang_355', '=', '001_001_lang.id_001')
            ->join('001_010_user', '013_355_article.author_355', '=', '001_010_user.id_010')
            ->join('013_350_section', '013_355_article.section_355', '=', '013_350_section.id_350')
            ->leftJoin('013_351_article_family', '013_355_article.family_355', '=', '013_351_article_family.id_351');
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_355');
    }

    public function getAuthor()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\User', 'author_355');
    }

    public function getFamily()
    {
        return $this->belongsTo('Syscover\Cms\Models\ArticleFamily', 'family_355');
    }

    public function getAttachments()
    {
        return $this->hasMany('Syscover\Pulsar\Models\Attachment','object_016')
            ->where('001_016_attachment.lang_016', $this->lang_355)
            ->where('001_016_attachment.resource_016', 'cms-article')
            ->leftJoin('001_015_attachment_family', '001_016_attachment.family_016', '=', '001_015_attachment_family.id_015')
            ->orderBy('001_016_attachment.sorting_016');
    }

    public function getCategories()
    {
        return $this->belongsToMany('Syscover\Cms\Models\Category', '013_356_articles_categories', 'article_356', 'category_356');
    }

    public function getTags()
    {
        return $this->belongsToMany('Syscover\Cms\Models\Tag', '013_359_articles_tags', 'article_359','tag_359');
    }

    public static function addToGetIndexRecords($parameters)
    {
        $query =  Article::builder();

        if(isset($parameters['lang'])) $query->where('lang_355', $parameters['lang']);

        return $query;
    }

    public static function customCount($parameters)
    {
        return Article::where('lang_355', $parameters['lang'])->getQuery();
    }

    public static function getTranslationPublishArticles($parameters)
    {
        return Article::builder()
            ->where('lang_355', $parameters['lang'])
            ->where('publish_355', '<' , date('U'))
            ->where('status_355', 1)
            ->orderBy('sorting_355')
            ->orderBy('date_355', 'desc')
            ->get();
    }
}