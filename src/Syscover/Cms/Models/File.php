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

class File extends Model {

    use TraitModel;

	protected $table        = '013_354_file';
    protected $primaryKey   = 'id_354';
    protected $sufix        = '354';
    public $timestamps      = false;
    protected $fillable     = ['id_354', 'file_354', 'mime_354', 'size_354', 'is_image_354', 'width_354', 'height_354', 'data_354'];
    private static $rules   = [
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}