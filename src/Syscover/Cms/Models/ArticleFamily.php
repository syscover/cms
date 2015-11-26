<?php namespace Syscover\Cms\Models;

/**
 * @package	    Pulsar
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;

class ArticleFamily extends Model {

    use TraitModel;

	protected $table        = '013_351_article_family';
    protected $primaryKey   = 'id_351';
    public $timestamps      = false;
    protected $fillable     = ['id_351', 'name_351', 'editor_type_351', 'custom_field_group_351', 'data_351'];
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
        $query =  ArticleFamily::leftJoin('001_025_field_group', '013_351_article_family.custom_field_group_351', '=', '001_025_field_group.id_025')
            ->newQuery();

        return $query;
    }

    public static function showRecord()
    {
        ArticleFamily::leftJoin('001_025_field_group', '013_351_article_family.custom_field_group_351', '=', '001_025_field_group.id_025')
            ->get()
            ->first();
    }
}