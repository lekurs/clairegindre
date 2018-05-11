<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/02/2018
 * Time: 14:29
 */

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class PictureUploaderHelper
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string $dirName
     * @param string $fileName
     */
    public function move(UploadedFile $uploadedFile, string $dirName, string $fileName)
    {
        $uploadedFile->move($dirName, $fileName);
    }
}
