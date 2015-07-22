<?php namespace Syscover\Cms\Controllers;

/**
 * @package	    Cms
 * @author	    Jose Carlos Rodríguez Palacín
 * @copyright   Copyright (c) 2015, SYSCOVER, SL
 * @license
 * @link		http://www.syscover.com
 * @since		Version 2.0
 * @filesource
 */

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\File;
use Syscover\Cms\Models\Attachment;
use Syscover\Pulsar\Controllers\Controller;

class AttachmentController extends Controller {

    public function storeAttachment(HttpRequest $request)
    {
        $parameters             = $request->route()->parameters();
        $attachments            = $request->input('attachments');
        $attachmentsResponse    = [];

        foreach($attachments as $attachment)
        {
            $idAttachment = Attachment::max('id_357');
            $idAttachment++;

            $width = null; $height= null;
            if($attachment['type']['id'] == 1)
            {
                list($width, $height) = getimagesize(public_path() . $attachment['folder'] . '/' . $attachment['fileName']);
            }

            // move file fom temp file to attachment folder
            File::move(public_path() . $attachment['folder'] . '/' . $attachment['fileName'], public_path() . Attachment::$folder . '/' . $parameters['article'] . '/' . $parameters['lang'] . '/' . $attachment['fileName']);

            $attachmentsResponse[] = Attachment::create([
                'id_357'                => $idAttachment,
                'lang_357'              => $parameters['lang'],
                'article_357'           => $parameters['article'],
                'family_357'            => $attachment['family'] == ""? null : $attachment['family'],
                'library_357'           => $attachment['library'],
                'library_file_name_357' => $attachment['libraryFileName'] == ""? null : $attachment['libraryFileName'],
                'sorting_357'           => isset($attachment['sorting'])? $attachment['sorting'] : null,
                'name_357'              => $attachment['imageName'] == ""? null : $attachment['imageName'],
                'file_name_357'         => $attachment['fileName'] == ""? null : $attachment['fileName'],
                'mime_357'              => $attachment['mime'],
                'size_357'              => filesize(public_path() . Attachment::$folder . '/' . $parameters['article'] . '/' . $parameters['lang'] . '/' . $attachment['fileName']),
                'type_357'              => $attachment['type']['id'],
                'type_text_357'         => $attachment['type']['name'],
                'width_357'             => $width,
                'height_357'            => $height,
                'data_357'              => null
            ]);
        }

        $response = [
            'success'       => true,
            'attachments'   => $attachmentsResponse
        ];

        return response()->json($response);

    }

    public function apiUpdateAttachment(HttpRequest $request)
    {
        $parameters = $request->route()->parameters();
        $attachment = $request->input('attachment');

        // check that is a attachment stored
        if(isset($attachment['id']))
        {
            $width = null; $height= null;
            if($attachment['type']['id'] == 1)
            {
                list($width, $height) = getimagesize(public_path() . $attachment['folder'] . '/' . $attachment['fileName']);
            }

            Attachment::where('id_357', $attachment['id'])->where('lang_357', $parameters['lang'])->update([
                'family_357'            => $attachment['family'] == ""? null : $attachment['family'],
                'library_357'           => $attachment['library'],
                'library_file_name_357' => $attachment['libraryFileName'] == ""? null : $attachment['libraryFileName'],
                'sorting_357'           => $attachment['sorting'],
                'name_357'              => $attachment['imageName'] == ""? null : $attachment['imageName'],
                'file_name_357'         => $attachment['fileName'] == ""? null : $attachment['fileName'],
                'mime_357'              => $attachment['mime'],
                'size_357'              => filesize(public_path() . Attachment::$folder . '/' . $parameters['article'] . '/' . $parameters['lang'] . '/' . $attachment['fileName']),
                'type_357'              => $attachment['type']['id'],
                'type_text_357'         => $attachment['type']['name'],
                'width_357'             => $width,
                'height_357'            => $height
            ]);
        }

        $response = [
            'success' => true,
            'message' => "Attachment updated"
        ];

        return response()->json($response);
    }

    public function apiUpdatesAttachment(HttpRequest $request)
    {
        $parameters = $request->route()->parameters();
        $attachments = $request->input('attachments');

        foreach($attachments as $attachment)
        {
            // check that is a attachment stored
            if(isset($attachment['id']))
            {
                $width = null; $height= null;
                if($attachment['type']['id'] == 1)
                {
                    list($width, $height) = getimagesize(public_path() . $attachment['folder'] . '/' . $attachment['fileName']);
                }

                Attachment::where('id_357', $attachment['id'])->where('lang_357', $parameters['lang'])->update([
                    'family_357'            => $attachment['family'] == ""? null : $attachment['family'],
                    'library_357'           => $attachment['library'],
                    'library_file_name_357' => $attachment['libraryFileName'] == ""? null : $attachment['libraryFileName'],
                    'sorting_357'           => $attachment['sorting'],
                    'name_357'              => $attachment['imageName'] == ""? null : $attachment['imageName'],
                    'file_name_357'         => $attachment['fileName'] == ""? null : $attachment['fileName'],
                    'mime_357'              => $attachment['mime'],
                    'size_357'              => filesize(public_path() . Attachment::$folder . '/' . $parameters['article'] . '/' . $parameters['lang'] . '/' . $attachment['fileName']),
                    'type_357'              => $attachment['type']['id'],
                    'type_text_357'         => $attachment['type']['name'],
                    'width_357'             => $width,
                    'height_357'            => $height
                ]);
            }
        }

        $response = [
            'success' => true,
            'message' => "Attachments updated"
        ];

        return response()->json($response);
    }

    public function apiDeleteAttachment(HttpRequest $request)
    {
        $parameters = $request->route()->parameters();

        $attachment = Attachment::getTranslationRecord($parameters['id'], $parameters['lang']);

        if($attachment->file_name_357 != null && $attachment->file_name_357 != "")
        {
            File::delete(public_path() . Attachment::$folder . '/' . $attachment->article_357 . '/' . $attachment->lang_357 . '/' . $attachment->file_name_357);
        }

        Attachment::deleteTranslationRecord($parameters['id'], $parameters['lang']);

        $response = [
            'success' => true,
            'message' => "Attachment deleted"
        ];

        return response()->json($response);
    }
}