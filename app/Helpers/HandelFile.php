<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
class HandelFile
{
    public static function uploadFile(UploadedFile $file, $oldFilename = null, $directory): string
    {
        $directoryPath = public_path($directory);

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($directoryPath, $filename);
        if ($oldFilename) {
            $oldFilePath = public_path($oldFilename);
            if (file_exists($oldFilePath)) {
                @unlink($oldFilePath);
            }
        }
        return $directory . $filename;
    }
    public static function deleteFile($filepath): bool
    {
        $fullPath = public_path($filepath);
        if (file_exists($fullPath)) {
            return @unlink($fullPath);
        }
        return false;
    }
}
