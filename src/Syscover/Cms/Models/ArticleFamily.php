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
    protected $suffix       = '351';
    public $timestamps      = false;
    protected $fillable     = ['id_351', 'name_351', 'editor_type_351', 'custom_field_group_351', 'data_351'];
    protected $maps         = [];
    protected $relationMaps = [
        'custom_field_group'  => \Syscover\Pulsar\Models\CustomFieldGroup::class
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
        return $query->leftJoin('001_025_field_group', '013_351_article_family.custom_field_group_351', '=', '001_025_field_group.id_025');
    }

    public function getCustomFieldGroup()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\CustomFieldGroup', 'custom_field_group_351');
    }

    public static function addToGetRecordsLimit()
    {
        $query =  ArticleFamily::builder();

        return $query;
    }

    public static function showRecord()
    {
        ArticleFamily::builder()
            ->get()
            ->first();
    }
}