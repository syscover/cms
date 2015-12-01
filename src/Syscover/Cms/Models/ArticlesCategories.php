<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class ArticlesCategories
 *
 * Model with properties
 * <br><b>[article, category]</b>
 *
 * @package     Syscover\Cms\Models
 */

class ArticlesCategories extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_356_articles_categories';
    protected $primaryKey   = 'article_356';
    protected $sufix        = '356';
    public $timestamps      = false;
    protected $fillable     = ['article_356', 'category_356'];
    protected $maps = [
        'article'           => 'article_356',
        'category'          => 'category_356',
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder()
    {
        return ArticlesCategories::join('013_352_category', '013_356_articles_categories.category_356', '=', '013_352_category.id_352');
    }
}