<?php namespace Syscover\Cms\Old\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Tag
 *
 * Model with properties
 * <br><b>[id, lang_id, name]</b>
 *
 * @package     Syscover\Cms\Old\Models
 */

class Tag extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_358_tag';
    protected $primaryKey   = 'id_358';
    protected $suffix       = '358';
    public $timestamps      = false;
    protected $fillable     = ['id_358', 'lang_id_358', 'name_358'];
    protected $maps         = [];
    protected $relationMaps = [];
    private static $rules   = [
        'name'  => 'required|between:1,255'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query;
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_id_358');
    }
}