<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 11/05/2018
 * Time: 13:07
 */

namespace App\Services\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface PictureUploaderHelperInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string $dirName
     * @param string $fileName
     * @return mixed
     */
    public function move(UploadedFile $uploadedFile, string $dirName, string $fileName);
}
