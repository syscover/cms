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

class Attachment extends Model {

    use TraitModel;

	protected $table        = '013_357_attachment';
    protected $primaryKey   = 'id_357';
    protected $sufix        = '357';
    public $timestamps      = false;
    public $incrementing    = false;
    protected $fillable     = ['id_357', 'lang_357', 'article_357', 'family_357', 'library_357', 'library_file_name_357', 'sorting_357', 'name_357', 'file_name_357', 'mime_357', 'size_357', 'type_357', 'type_text_357', 'width_357', 'height_357', 'data_lang_357', 'data_357'];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public static function getTranslationsAttachmentsArticle($parameters)
    {
        return Attachment::leftJoin('013_353_attachment_family', '013_357_attachment.family_357', '=', '013_353_attachment_family.id_353')
            ->where('lang_357', $parameters['lang'])
            ->where('article_357', $parameters['article'])
            ->orderBy('sorting_357')
            ->get();
    }

    public static function getCustomTranslationRecord($parameters)
    {
        return Attachment::leftJoin('013_353_attachment_family', '013_357_attachment.family_357', '=', '013_353_attachment_family.id_353')
            ->where('id_357', $parameters['id'])
            ->where('lang_357', $parameters['lang'])
            ->first();
    }
}