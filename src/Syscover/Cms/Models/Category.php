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
 * <br><b>[id, lang, name, sorting, data_lang, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Category extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_352_category';
    protected $primaryKey   = 'id_352';
    protected $sufix        = '352';
    public $timestamps      = false;
    protected $fillable     = ['id_352', 'lang_352', 'name_352', 'sorting_352', 'data_lang_352', 'data_352'];
    protected $maps = [
        'id'                => 'id_352',
        'lang'              => 'lang_352',
        'name'              => 'name_352',
        'sorting'           => 'sorting_352',
        'data_lang'         => 'data_lang_352',
        'data'              => 'data_352',
    ];
    private static $rules   = [
        'name'  => 'required|between:2,100'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function lang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_352');
    }

    public static function addToGetRecordsLimit($parameters)
    {
        $query =  Category::join('001_001_lang', '013_352_category.lang_352', '=', '001_001_lang.id_001');

        if(isset($parameters['lang'])) $query->where('lang_352', $parameters['lang']);

        return $query;
    }
}