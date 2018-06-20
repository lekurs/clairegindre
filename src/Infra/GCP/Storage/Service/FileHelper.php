<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:43
 */

namespace App\Infra\GCP\Storage\Service;


use App\Infra\GCP\Storage\Helper\Interfaces\StorageWriterInterface;
use App\Infra\GCP\Storage\Service\Interfaces\FileHelperInterface;

final class FileHelper implements FileHelperInterface
{
    /**
     * @var string
     */
    private $newFileName;

    /**
     * @var StorageWriterInterface
     */
    private $storageWriter;

    /**
     * @var string
     */
    private $bucketName;

    /**
     * FileHelper constructor.
     *
     * @param StorageWriterInterface $storageWriter
     * @param string $bucketName
     */
    public function __construct(StorageWriterInterface $storageWriter, string $bucketName)
    {
        $this->storageWriter = $storageWriter;
        $this->bucketName = $bucketName;
    }

    /**
     * @param \SplFileInfo $file
     * @return string
     */
    public function generateFileName(\SplFileInfo $file): string
    {
        return $this->newFileName = md5(str_rot13(uniqid())) . "." . $file->guessExtension();
    }

    /**
     * @param \SplFileInfo $toUploadFile
     * @param string $uploadDirectory
     */
    public function upload(\SplFileInfo $toUploadFile, string $uploadDirectory): void
    {
        $this->storageWriter->writeBucket($this->bucketName, $toUploadFile->getPathname(), [
            'name' => $uploadDirectory . '/' . $this->newFileName
        ]);
    }

    /**
     * @param $bucketName
     */
    public function deleteDirectory($bucketName) : void
    {
        $this->storageWriter->deleteBucket($bucketName . '/');
    }
}
