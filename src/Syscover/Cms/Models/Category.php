<?php namespace Syscover\Cms\Old\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Category
 *
 * Model with properties
 * <br><b>[id, lang_id, name, slug, sorting, data_lang, data]</b>
 *
 * @package     Syscover\Cms\Old\Models
 */

class Category extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_352_category';
    protected $primaryKey   = 'id_352';
    protected $suffix       = '352';
    public $timestamps      = false;
    protected $fillable     = ['id_352', 'lang_id_352', 'name_352', 'slug_352', 'sorting_352', 'data_lang_352', 'data_352'];
    protected $maps         = [];
    protected $relationMaps = [
        'lang'  => \Syscover\Pulsar\Models\Lang::class
    ];
    private static $rules   = [
        'name'  => 'required|between:2,100'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('001_001_lang', '013_352_category.lang_id_352', '=', '001_001_lang.id_001');
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_id_352');
    }

    public function addToGetIndexRecords($request, $parameters)
    {
        $query =  $this->builder();

        if(isset($parameters['lang'])) $query->where('lang_id_352', $parameters['lang']);

        return $query;
    }

    public static function customCount($request, $parameters)
    {
        return Category::where('lang_id_352', $parameters['lang'])->getQuery();
    }
}