<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 22/06/2018
 * Time: 09:13
 */

namespace App\Services;


use App\Services\Interfaces\ResizeImageHelperInterface;
use Symfony\Component\Filesystem\Filesystem;

final class ResizeImageHelper implements ResizeImageHelperInterface
{
    private $fileHelper;

    private $dirGallery;

    /**
     * ResizeImageHelper constructor.
     * @param Filesystem $fileHelper
     * @param string $dirGallery
     */
    public function __construct(Filesystem $fileHelper, string $dirGallery)
    {
        $this->fileHelper = $fileHelper;
        $this->dirGallery = $dirGallery;
    }

    /**
     * @param \SplFileInfo $image
     * @param $directory
     * @param $newName
     * @return mixed|void
     */
    public function resize(\SplFileInfo $image, $directory, $newName)
    {
        $sizeOriginal = getimagesize($image);

        $newWidth = 640; //On détermine la taille qu'on souhaite pour la nouvelle image en px

        $resize = ( ($newWidth * 100)/ $sizeOriginal[0]); // % de réduction = au quotient de l'ancienne largeur vs newPicture

        $newHeight = ( ($sizeOriginal[1] * $resize) / 100); //On calcul la hauteur homotétiquement

        $newPicture = imagecreatefromjpeg($image); //Création de la nouvelle image

        $imageBackupCreation = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($imageBackupCreation, $newPicture, 0, 0, 0 ,0, $newWidth, $newHeight, $sizeOriginal[0], $sizeOriginal[1]);

        imagejpeg($newPicture, $directory . '/' . $newName, 75);

    }

        public function moveTmp(\SplFileInfo $file, $directory)
    {
        $this->fileHelper->mkdir($directory, '0777');

        move_uploaded_file($file, $directory . '/' . $file->getClientOriginalName());
    }
}


///**
// * Created by PhpStorm.
// * User: Maxime GINDRE
// * Date: 22/06/2018
// * Time: 09:13
// */
//
//namespace App\Services;
//
//
//use App\Services\Interfaces\ResizeImageHelperInterface;
//use Symfony\Component\Filesystem\Filesystem;
//
//final class ResizeImageHelper implements ResizeImageHelperInterface
//{
//
//    private $fileHelper;
//
//    private $dirGallery;
//
//    /**
//     * ResizeImageHelper constructor.
//     * @param $fileHelper
//     */
//    public function __construct(Filesystem $fileHelper, string $dirGallery)
//    {
//        $this->fileHelper = $fileHelper;
//        $this->dirGallery = $dirGallery;
//    }
//
//    /**
//     * @param \SplFileInfo $image
//     * @param $directory
//     * @param null $newName
//     * @return mixed|void
//     * @throws \ImagickException
//     */
//    public function readDirectory($name)
//    {
//
//        if (is_dir($name)) {
//            if ($dir = opendir($name)) {
////                while (($file = readdir($dir)) !== false) {
////                    if (is_dir($dir)) {
//                       while (($image = readdir($dir)) !== false) {
//                           if ($image != "." && $image != "..") {
//                               echo $image . '<br>';
////                           foreach ($image as $test) {
////                               $tests = opendir($test);
////                               dump($tests);
////                           }
//                               $imagick = new \Imagick($image);
//                               $imagick->thumbnailImage(500, 0);
////                               $sizeOriginal = getimagesize($image);
//////
////                                $newWidth = 640; //On détermine la taille qu'on souhaite pour la nouvelle image en px
////
////                                $resize = ( ($newWidth * 100)/ $sizeOriginal[0]); // % de réduction = au quotient de l'ancienne largeur vs newPicture
////
////                                $newHeight = ( ($sizeOriginal[1] * $resize) / 100); //On calcul la hauteur homotétiquement
////
////                                $newPicture = imagecreatefromjpeg($image); //Création de la nouvelle image
////
////                                $imageBackupCreation = imagecreatetruecolor($newWidth, $newHeight);
////
////                                imagecopyresampled($imageBackupCreation, $newPicture, 0, 0, 0 ,0, $newWidth, $newHeight, $sizeOriginal[0], $sizeOriginal[1]);
////
////                                imagejpeg($newPicture, $name . '/' . uniqid(), 75);
//                           }
//                       }
////                    }
////                }
//            };
//
//        }
//
//        die;
////        $newFile = fopen($this->dirGallery. '/' . $image->getClientOriginalName(), 'r+');
//
//        $imagick = new \Imagick($newFile);
//
//        $imagick->thumbnailImage(500, 0);
//
//        $this->fileHelper->copy($newFile, 'mini_', $newFile->getClientOriginalName(), false);
//
////        $sizeOriginal = getimagesize($image);
////
////        $newWidth = 640; //On détermine la taille qu'on souhaite pour la nouvelle image en px
////
////        $resize = ( ($newWidth * 100)/ $sizeOriginal[0]); // % de réduction = au quotient de l'ancienne largeur vs newPicture
////
////        $newHeight = ( ($sizeOriginal[1] * $resize) / 100); //On calcul la hauteur homotétiquement
////
////        $newPicture = imagecreatefromjpeg($image); //Création de la nouvelle image
////
////        $imageBackupCreation = imagecreatetruecolor($newWidth, $newHeight);
////
////        imagecopyresampled($imageBackupCreation, $newPicture, 0, 0, 0 ,0, $newWidth, $newHeight, $sizeOriginal[0], $sizeOriginal[1]);
////
////        imagejpeg($newPicture, $directory . '/' . $newName, 75);
////
//    }
//
//    public function moveTmp(\SplFileInfo $file, $directory)
//    {
//        $this->fileHelper->mkdir($directory, '0777');
//
//        move_uploaded_file($file, $directory . '/' . $file->getClientOriginalName());
//    }
//}
