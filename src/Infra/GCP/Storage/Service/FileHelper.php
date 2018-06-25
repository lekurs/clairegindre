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
     * @var SlugHelperInterface
     */
    private $slugHelper;

    /**
     * FileHelper constructor.
     *
     * @param StorageWriterInterface $storageWriter
     * @param string $bucketName
     */
    public function __construct(StorageWriterInterface $storageWriter, string $bucketName, string $backupBucket, SlugHelperInterface $slugHelper)
    {
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
        dump($file->getClientOriginalName());
        die;
        return $this->newFileName = strtolower($this->slugHelper->replace($file->getClientOriginalName()));
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
    public function deleteDirectory($directory) : void
    {
        $this->storageWriter->deleteBucket($this->bucketName, $directory . '/');
    }
}
