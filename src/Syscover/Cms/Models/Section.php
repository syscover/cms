<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class Section
 *
 * Model with properties
 * <br><b>[id, name, article_family]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Section extends Model {

    use Eloquence, Mappable;

	protected $table        = '013_350_section';
    protected $primaryKey   = 'id_350';
    public $timestamps      = false;
    protected $fillable     = ['id_350', 'name_350', 'article_family_350'];
    protected $maps = [
        'id'                => 'id_350',
        'name'              => 'name_350',
        'article_family'    => 'article_family_350',
    ];
    private static $rules   = [
        'id'    => 'required|between:2,30|unique:013_350_section,id_350',
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,30';

        return Validator::make($data, static::$rules);
	}

    public static function addToGetRecordsLimit($parameters)
    {
        $query =  Section::leftJoin('013_351_article_family', '013_350_section.article_family_350', '=', '013_351_article_family.id_351');

        return $query;
    }
}