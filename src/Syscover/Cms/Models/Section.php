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

class Section extends Model {

    use TraitModel;

	protected $table        = '013_350_section';
    protected $primaryKey   = 'id_350';
    public $timestamps      = false;
    protected $fillable     = ['id_350', 'name_350', 'article_family_350'];
    private static $rules   = [
        'id'    => 'required|between:2,30|unique:013_350_section,id_350',
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,30';

        return Validator::make($data, static::$rules);
	}

    public static function getCustomRecordsLimit($parameters)
    {
        $query =  Section::leftJoin('013_351_article_family', '013_350_section.article_family_350', '=', '013_351_article_family.id_351')->newQuery();

        return $query;
    }
}