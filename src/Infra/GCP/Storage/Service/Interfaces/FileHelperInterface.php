<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:53
 */

namespace App\Infra\GCP\Storage\Service\Interfaces;


use App\Infra\GCP\Storage\Helper\Interfaces\StorageWriterInterface;

interface FileHelperInterface
{
    /**
     * FileHelperInterface constructor.
     *
     * @param StorageWriterInterface $storageWriter
     * @param string $bucketName
     * @param string $backupBucket
     */
    public function __construct(
        StorageWriterInterface $storageWriter,
        string $bucketName,
        string $backupBucket
    );

    /**
     * @param \SplFileInfo $file
     * @return string
     */
    public function generateFileName(\SplFileInfo $file): string ;

    /**
     * @param \SplFileInfo $toUploadFile
     * @param string $uploadDirectory
     */
    public function upload(\SplFileInfo $toUploadFile, string $uploadDirectory): void;

    /**
     * @param string $directory
     * @param string $filename
     * @param string $destination
     */
    public function downloadFile(string $directory, string $filename, string $destination): void;

    /**
     * @param string $directory
     * @param string $fileName
     */
    public function deleteDirectory(string $directory, string $fileName) : void;
}
