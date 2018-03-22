<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/02/2018
 * Time: 14:29
 */

namespace App\Services;



use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function move(UploadedFile $uploadedFile)
    {
            $pictureName = md5(uniqid()).'.'.$uploadedFile->guessExtension();

            $uploadedFile->move($this->targetDir, $pictureName);

            return $pictureName;
    }

    //Prévoir le nom public
    private function directory($name, Filesystem $filesystem)
    {
        $filesystem->mkdir($name);
    }
}