<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/02/2018
 * Time: 14:29
 */

namespace App\Services;



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
            $pictureName = $this->namePicture().'.'.$uploadedFile->guessExtension();

            $uploadedFile->move($this->targetDir, $pictureName);

            return $pictureName;
    }

    private function namePicture()
    {
        return md5(uniqid());
    }
}