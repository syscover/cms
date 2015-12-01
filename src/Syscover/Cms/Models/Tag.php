<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class Tag
 *
 * Model with properties
 * <br><b>[id, lang, name]</b>
 *
 * @package     Syscover\Cms\Models
 */

class Tag extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_358_tag';
    protected $primaryKey   = 'id_358';
    protected $sufix        = '358';
    public $timestamps      = false;
    protected $fillable     = ['id_358', 'lang_358', 'name_358'];
    protected $maps = [
        'id'                => 'id_358',
        'lang'              => 'lang_358',
        'name'              => 'name_358',
    ];
    private static $rules   = [
        'name'  => 'required|between:1,100'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function lang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_358');
    }
}