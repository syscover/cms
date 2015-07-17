<?php namespace Syscover\Cms\Models;

/**
 * @package	    Cms
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

class Library extends Model {

    use TraitModel;

	protected $table        = '013_354_library';
    protected $primaryKey   = 'id_354';
    protected $sufix        = '354';
    public $timestamps      = false;
    protected $fillable     = ['id_354', 'file_name_354', 'mime_354', 'size_354', 'type_354', 'type_text_354', 'width_354', 'height_354', 'data_354'];
    private static $rules   = [
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}