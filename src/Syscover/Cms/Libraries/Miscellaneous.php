<?php namespace Syscover\Cms\Libraries;

/**
 * @package		Pulsar
 * @author		Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2014, SYSCOVER, SL.
 * @license		
 * @link		http://www.syscover.com
 * @since		Version 1.0
 * @filesource  Librarie that instance helper functions
 */

class Miscellaneous
{
    /**
     *  Funtion to get excerpt from news
     *
     * @access  public
     * @param   string  $str
     * @param   int     $startPos
     * @param   int     $maxLength
     * @param   boolean $stripTags
     * @return  string
     */
    public static function getExcerpt($str, $startPos=0, $maxLength=100, $stripTags=true)
    {
        if($stripTags)
            $str = strip_tags($str);

        if(strlen($str) > $maxLength)
        {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        }
        else
        {
            $excerpt = $str;
        }

        return $excerpt;
    }
}