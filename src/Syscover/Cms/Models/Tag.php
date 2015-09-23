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

class Tag extends Model {

    use TraitModel;

	protected $table        = '013_358_tag';
    protected $primaryKey   = 'id_358';
    public $timestamps      = false;
    protected $fillable     = ['id_358', 'lang_358', 'name_358'];
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