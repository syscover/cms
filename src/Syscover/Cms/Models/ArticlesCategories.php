<?php namespace Syscover\Cms\Old\Models;

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
 * @package     Syscover\Cms\Old\Models
 */

class ArticlesCategories extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_356_articles_categories';
    protected $primaryKey   = 'article_id_356';
    protected $suffix       = '356';
    public $timestamps      = false;
    protected $fillable     = ['article_id_356', 'category_id_356'];
    protected $maps         = [];
    protected $relationMaps = [
        'category'  => \Syscover\Cms\Old\Models\Category::class
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('013_352_category', '013_356_articles_categories.category_id_356', '=', '013_352_category.id_352');
    }
}