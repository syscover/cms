<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class Category
 *
 * Model with properties
 * <br><b>[id, lang, name, slug, sorting, data_lang, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Category extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_352_category';
    protected $primaryKey   = 'id_352';
    protected $suffix       = '352';
    public $timestamps      = false;
    protected $fillable     = ['id_352', 'lang_352', 'name_352', 'slug_352', 'sorting_352', 'data_lang_352', 'data_352'];
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
        return $query->join('001_001_lang', '013_352_category.lang_352', '=', '001_001_lang.id_001');
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_352');
    }

    public function addToGetIndexRecords($request, $parameters)
    {
        $query =  $this->builder();

        if(isset($parameters['lang'])) $query->where('lang_352', $parameters['lang']);

        return $query;
    }

    public static function customCount($request, $parameters)
    {
        return Category::where('lang_352', $parameters['lang'])->getQuery();
    }
}