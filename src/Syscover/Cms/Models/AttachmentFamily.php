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

class AttachmentFamily extends Model {

    use TraitModel;

	protected $table        = '013_353_attachment_family';
    protected $primaryKey   = 'id_353';
    public $timestamps      = false;
    protected $fillable     = ['id_353', 'name_353', 'width_353', 'height_353', 'data_353'];
    private static $rules   = [
        'name'      => 'required|between:2,100',
        'width'     => 'numeric',
        'height'    => 'numeric'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}