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
use App\Services\Interfaces\SlugHelperInterface;

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
     * @var string
     */
    private $backupBucket;

    /**
     * FileHelper constructor.
     *
     * @param StorageWriterInterface $storageWriter
     * @param string $bucketName
     * @param string $backupBucket
     */
    public function __construct(
        StorageWriterInterface $storageWriter,
        string $bucketName,
        string $backupBucket
    ) {
        $this->storageWriter = $storageWriter;
        $this->bucketName = $bucketName;
        $this->backupBucket = $backupBucket;
    }

    /**
     * @param \SplFileInfo $file
     * @return string
     */
    public function generateFileName(\SplFileInfo $file): string
    {
        return $this->newFileName = strtolower($file->getClientOriginalName());
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

    public function uploadMini(\SplFileInfo $toUploadFile, string $uploadDirectory): void
    {
        $this->storageWriter->writeBucket($this->backupBucket, $toUploadFile->getPathname(), [
            'name' => $uploadDirectory . '/' . $this->newFileName
        ]);
    }

    /**
     * @param $directory
     * @param $filename
     * @param $destination
     */
    public function downloadFile($directory, $filename, $destination): void
    {
        $object = $this->storageWriter->dl($this->bucketName, $directory, $filename);

        $object->downloadToFile($destination);
    }

    /**
     * @param $directory
     */
    public function deleteDirectory($directory, $fileName) : void
    {
        $this->storageWriter->deleteBucket($this->bucketName, $directory . '/' . $fileName);
    }
}
