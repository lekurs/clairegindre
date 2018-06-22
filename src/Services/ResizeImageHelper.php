<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 22/06/2018
 * Time: 09:13
 */

namespace App\Services;


use App\Services\Interfaces\ResizeImageHelperInterface;

final class ResizeImageHelper implements ResizeImageHelperInterface
{
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

        imagejpeg($newPicture, $directory . '/' . $newName . '.jpg', 75);

    }
}
