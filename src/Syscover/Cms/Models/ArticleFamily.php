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

class ArticleFamily extends Model {

    use ModelTrait;

	protected $table        = '013_351_article_family';
    protected $primaryKey   = 'id_351';
    public $timestamps      = false;
    protected $fillable     = ['id_351', 'name_351', 'image_width_351', 'image_height_351', 'editor_type_351', 'data_351'];
    private static $rules   = [
        'name'  => 'required|between:2,100'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
}