<?php namespace Syscover\Cms\Models;

/**
 * @package	    Cms
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class Article extends Model {

    use TraitModel;

	protected $table        = '013_355_article';
    protected $primaryKey   = 'id_355';
    protected $sufix        = '355';
    public $timestamps      = false;
    public $incrementing    = false;
    protected $fillable     = ['id_355', 'lang_355', 'section_355', 'family_355', 'author_355', 'date_355', 'publish_355', 'status_355', 'title_355', 'slug_355', 'sorting_355', 'tags_355', 'article_355', 'data_355'];
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

    public function lang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_355');
    }

    public function categories()
    {
        return Article::belongsToMany('Syscover\Cms\Models\Category','013_356_articles_categories','article_356','category_356');
    }

    public static function getCustomRecordsLimit($parameters)
    {
        $query =  Article::join('001_001_lang', '013_355_article.lang_355', '=', '001_001_lang.id_001')
            ->join('013_350_section', '013_355_article.section_355', '=', '013_350_section.id_350')
            ->newQuery();

        if(isset($parameters['lang'])) $query->where('lang_355', $parameters['lang']);

        return $query;
    }

    public static function getCustomTranslationRecord($parameters)
    {
        return Article::join('001_001_lang', '013_355_article.lang_355', '=', '001_001_lang.id_001')
            ->join('001_010_user', '013_355_article.author_355', '=', '001_010_user.id_010')
            ->join('013_350_section', '013_355_article.section_355', '=', '013_350_section.id_350')
            ->leftJoin('013_351_article_family', '013_355_article.family_355', '=', '013_351_article_family.id_351')
            ->where('id_355', $parameters['id'])
            ->where('lang_355', $parameters['lang'])
            ->first();
    }
}