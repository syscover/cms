<?php namespace Syscover\Cms\Models;

/**
 * @package	    Syscover\Cms\Models
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

class ArticlesCategories extends Model {

    use TraitModel;

	protected $table        = '013_356_articles_categories';
    protected $primaryKey   = 'article_356';
    protected $sufix        = '356';
    public $timestamps      = false;
    protected $fillable     = ['article_356', 'category_356'];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder()
    {
        return ArticlesCategories::join('013_352_category', '013_356_articles_categories.category_356', '=', '013_352_category.id_352')
            ->newQuery();
    }
}