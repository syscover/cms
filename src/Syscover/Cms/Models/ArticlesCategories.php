<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

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
    use Eloquence, Mappable;

	protected $table        = '013_356_articles_categories';
    protected $primaryKey   = 'article_356';
    protected $suffix       = '356';
    public $timestamps      = false;
    protected $fillable     = ['article_356', 'category_356'];
    protected $maps         = [];
    protected $relationMaps = [
        'category'  => \Syscover\Cms\Models\Category::class
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('013_352_category', '013_356_articles_categories.category_356', '=', '013_352_category.id_352');
    }
}