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
use Syscover\Pulsar\Traits\ModelTrait;

class Section extends Model {

    use ModelTrait;

	protected $table        = '013_350_section';
    protected $primaryKey   = 'id_350';
    public $timestamps      = false;
    protected $fillable     = ['id_350', 'name_350'];
    private static $rules   = [
        'id'    => 'required|between:2,30|unique:013_350_section,id_350',
        'name'  => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,30';

        return Validator::make($data, static::$rules);
	}
}