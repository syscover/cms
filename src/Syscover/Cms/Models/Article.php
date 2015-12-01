<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Syscover\Pulsar\Models\User;

/**
 * Class Article
 *
 * Model with properties
 * <br><b>[id, lang, section, family, author, date, publish, publish_text, status, title, slug, sorting, article, data_lan, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Article extends Model {

    use Eloquence, Mappable;

	protected $table        = '013_355_article';
    protected $primaryKey   = 'id_355';
    protected $sufix        = '355';
    public $timestamps      = false;
    public $incrementing    = false;
    protected $fillable     = ['id_355', 'lang_355', 'section_355', 'family_355', 'author_355', 'date_355', 'publish_355', 'publish_text_355', 'status_355', 'title_355', 'slug_355', 'sorting_355', 'article_355', 'data_lang_355', 'data_355'];
    protected $maps = [
        'id'                => 'id_355',
        'lang'              => 'lang_355',
        'section'           => 'section_355',
        'family'            => 'family_355',
        'author'            => 'author_355',
        'date'              => 'date_355',
        'publish'           => 'publish_355',
        'publish_text'      => 'publish_text_355',
        'status'            => 'status_355',
        'title'             => 'title_355',
        'slug'              => 'slug_355',
        'sorting'           => 'sorting_355',
        'article'           => 'article_355',
        'data_lan'          => 'data_lang_355',
        'data'              => 'data_355',
        // Syscover\Pulsar\Models\Lang
        'lang_id'                => 'id_001',
        'lang_name'              => 'name_001',
        'lang_image'             => 'image_001',
        'lang_sorting'           => 'sorting_001',
        'lang_base'              => 'base_001',
        'lang_active'            => 'active_001',
        // Syscover\Pulsar\Models\User
        'author_id'                => 'id_010',
        'author_lang'              => 'lang_010',
        'author_profile'           => 'profile_010',
        'author_access'            => 'access_010',
        'author_user'              => 'user_010',
        'author_password'          => 'password_010',
        'author_email'             => 'email_010',
        'author_name'              => 'name_010',
        'author_surname'           => 'surname_010',
        'author_profile_id'        => 'id_006',
        'author_profile_name'      => 'name_006',
        // Syscover\Cms\Models\Section
        'section_id'                => 'id_350',
        'section_name'              => 'name_350',
        'section_article_family'    => 'article_family_350',
        // Syscover\Cms\Models\ArticleFamily
        'family_id'                    => 'id_351',
        'family_name'                  => 'name_351',
        'family_editor_type'           => 'editor_type_351',
        'family_custom_field_group'    => 'custom_field_group_351',
        'family_data'                  => 'data_351',

    ];
    private static $rules   = [
        'title'     => 'between:2,510',
        'section'   => 'required',
        'status'    => 'required'
    ];

//    function __construct()
//    {
//        parent::__construct();
//
//
//        dd(User::$mappedAttributes);
//        //$this->maps[] = User::$mappedAttributes
//
//    }

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['slugRule']) && $specialRules['slugRule']) static::$rules['slug'] = 'unique:013_355_article,slug_355,NULL,013_355_article,lang_355,' . $data['lang'];

        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder()
    {
        return Article::join('001_001_lang', '013_355_article.lang_355', '=', '001_001_lang.id_001')
            ->join('001_010_user', '013_355_article.author_355', '=', '001_010_user.id_010')
            ->join('013_350_section', '013_355_article.section_355', '=', '013_350_section.id_350')
            ->leftJoin('013_351_article_family', '013_355_article.family_355', '=', '013_351_article_family.id_351');
    }

    public function lang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_355');
    }

    public function author()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\User', 'author_355');
    }

    public function family()
    {
        return $this->belongsTo('Syscover\Cms\Models\ArticleFamily', 'family_355');
    }

    public function attachments()
    {
        return $this->hasMany('Syscover\Pulsar\Models\Attachment','object_016')
            ->where('001_016_attachment.lang_016', $this->lang_355)
            ->where('001_016_attachment.resource_016', 'cms-article')
            ->leftJoin('001_015_attachment_family', '001_016_attachment.family_016', '=', '001_015_attachment_family.id_015')
            ->orderBy('001_016_attachment.sorting_016');
    }

    public function categories()
    {
        return $this->belongsToMany('Syscover\Cms\Models\Category', '013_356_articles_categories', 'article_356', 'category_356');
    }

    public function tags()
    {
        return $this->belongsToMany('Syscover\Cms\Models\Tag', '013_359_articles_tags', 'article_359','tag_359');
    }

    public static function addToGetRecordsLimit($parameters)
    {
        $query =  Article::builder()
            ->orderBy('id_355', 'desc');

        if(isset($parameters['lang'])) $query->where('lang_355', $parameters['lang']);

        return $query;
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