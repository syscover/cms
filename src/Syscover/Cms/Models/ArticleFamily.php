<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class ArticleFamily
 *
 * Model with properties
 * <br><b>[id, name, editor_type, custom_field_group, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class ArticleFamily extends Model
{
    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '013_351_article_family';
    protected $primaryKey   = 'id_351';
    public $timestamps      = false;
    protected $fillable     = ['id_351', 'name_351', 'editor_type_351', 'custom_field_group_351', 'data_351'];
    protected $maps = [
        'id'                    => 'id_351',
        'name'                  => 'name_351',
        'editor_type'           => 'editor_type_351',
        'custom_field_group'    => 'custom_field_group_351',
        'data'                  => 'data_351',
    ];
    private static $rules   = [
        'name'  => 'required|between:2,100'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function customFieldGroup()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\CustomFieldGroup', 'custom_field_group_351');
    }

    public static function addToGetRecordsLimit()
    {
        $query =  ArticleFamily::leftJoin('001_025_field_group', '013_351_article_family.custom_field_group_351', '=', '001_025_field_group.id_025');

        return $query;
    }

    public static function showRecord()
    {
        ArticleFamily::leftJoin('001_025_field_group', '013_351_article_family.custom_field_group_351', '=', '001_025_field_group.id_025')
            ->get()
            ->first();
    }
}