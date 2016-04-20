<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Section
 *
 * Model with properties
 * <br><b>[id, name, article_family]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Section extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_350_section';
    protected $primaryKey   = 'id_350';
    public $incrementing    = false;
    protected $suffix       = '350';
    public $timestamps      = false;
    protected $fillable     = ['id_350', 'name_350', 'article_family_350'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'id'    => 'required|between:2,30|unique:013_350_section,id_350',
        'name'  => 'required|between:2,255'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,30';

        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->leftJoin('013_351_article_family', '013_350_section.article_family_350', '=', '013_351_article_family.id_351');
    }
}