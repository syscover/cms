<?php namespace Syscover\Cms\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class ArticleFamily
 *
 * Model with properties
 * <br><b>[id, name, editor_id, field_group_id, data]</b>
 *
 * @package     Syscover\Cms\Models
 */

class ArticleFamily extends Model
{
    use Eloquence, Mappable;

	protected $table        = '013_351_article_family';
    protected $primaryKey   = 'id_351';
    protected $suffix       = '351';
    public $timestamps      = false;
    protected $fillable     = ['id_351', 'name_351', 'editor_id_351', 'field_group_id_351', 'data_351'];
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
        return $query->leftJoin('001_025_field_group', '013_351_article_family.field_group_id_351', '=', '001_025_field_group.id_025');
    }

    public function getCustomFieldGroup()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\CustomFieldGroup', 'field_group_id_351');
    }

    public static function showRecord()
    {
        ArticleFamily::builder()
            ->get()
            ->first();
    }
}