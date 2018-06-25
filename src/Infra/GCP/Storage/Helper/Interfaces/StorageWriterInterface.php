<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:33
 */

namespace App\Infra\GCP\Storage\Helper\Interfaces;


use App\Infra\GCP\Storage\Bridge\Interfaces\StorageBridgeInterface;
use Google\Cloud\Storage\StorageObject;

interface StorageWriterInterface
{
    /**
     * StorageWriterInterface constructor.
     *
     * @param StorageBridgeInterface $storageBridge
     */
    public function __construct(StorageBridgeInterface $storageBridge);

    /**
     * @param string $bucketName
     * @param string $fileName
     * @param array $opts
     * @return StorageObject
     */
    public function writeBucket(string $bucketName, string $fileName, $opts = []): StorageObject;

    /**
     * @param string $bucketName
     * @param string $directory
     * @param string $fileName
     */
    public function deleteBucket(string $bucketName, string $directory, string $fileName) : void;
}
