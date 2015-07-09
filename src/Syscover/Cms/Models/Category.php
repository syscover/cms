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

class Category extends Model {

    use TraitModel;

	protected $table        = '013_352_category';
    protected $primaryKey   = 'id_352';
    protected $sufix        = '352';
    public $timestamps      = false;
    protected $fillable     = ['id_352', 'lang_352', 'name_352', 'sorting_352', 'data_352'];
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

    public static function getCustomRecordsLimit($parameters)
    {
        $query =  Category::join('001_001_lang', '013_352_category.lang_352', '=', '001_001_lang.id_001')->newQuery();

        if(isset($parameters['lang'])) $query->where('lang_352', $parameters['lang']);

        return $query;
    }
}