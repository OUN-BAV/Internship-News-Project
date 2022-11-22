<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait {

    protected $isBase64 = 'data:image';

    // *** Base64 Upload MorphMany Files
    public static function base64MorphManyFiles($attr, $model)
    {
        if (request()->has($attr)) {
            foreach (request()->{$attr} as $img) {
                $file = self::base64Upload($img['url'], true);
                if ($file['file_name']) {
                    $model->galleries()->create([
                        'url' => $file['file_name'],
                        'mime_type' => $file['mime_type']
                    ]);
                }
            }
        }
    }

    public static function base64Upload($base64Image, $mimeType = false) {
        $self = new static;
        // decode string to file system
        if (str_starts_with($base64Image, $self->isBase64)) {
            @list($type, $fileData) = explode(';', $base64Image);
            @list(, $fileData) = explode(',', $fileData);
            $base64File = base64_decode($fileData);
            // convert base 64 to mime-type Ex: xlsx, pdf ...
            $mime = $self->mimeTypeMap(mime_content_type($base64Image));

            // generate file name after decode
            $fileName = md5($base64Image . time()) . '.' . "$mime";
            Storage::disk('upload')->put('uploads/galleries/' . $fileName, $base64File);
        }
        
        if ($mimeType) {
            return [
                "file_name" => $fileName ?? '',
                "mime_type" => $mime ?? ''
            ];
        }

        return $fileName ?? $base64Image;
    }


    public static function mimeTypeMap($mime)
    {
        $mimeMap = config('backpack.base.map');
        return isset($mimeMap[$mime]) === true ? $mimeMap[$mime] : false;
    }

}