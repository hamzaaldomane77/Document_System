<?php

namespace App\Http\Trait;

use Exception;
use Illuminate\Support\Str;

trait uploadFile
{
    public function uploadFile( $request, string $folder, string $fileColumnName)
    {

        $file = $request->file($fileColumnName);
        $originalName = $file->getClientOriginalName();

        if (preg_match('/\.[^.]+\./', $originalName)) {
            throw new Exception(trans('general.notAllowedAction'), 403);
        }

        $fileName = Str::random(32);
        $mime_type = $file->getClientOriginalExtension();;
        $type = explode('/', $mime_type);

        $path = $file->storeAs($folder, $fileName . '.' . end($type), 'public');
        return $path;
    }
}
