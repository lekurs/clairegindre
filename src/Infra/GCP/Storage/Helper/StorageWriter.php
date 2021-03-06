<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:29
 */

namespace App\Infra\GCP\Storage\Helper;


use App\Infra\GCP\Storage\Bridge\Interfaces\StorageBridgeInterface;
use App\Infra\GCP\Storage\Helper\Interfaces\StorageWriterInterface;
use Google\Cloud\Storage\StorageObject;

final class StorageWriter implements StorageWriterInterface
{
    /**
     * @var StorageBridgeInterface
     */
    private $storageBridge;

    /**
     * StorageWriter constructor.
     *
     * @param StorageBridgeInterface $storageBridge
     */
    public function __construct(StorageBridgeInterface $storageBridge)
    {
        $this->storageBridge = $storageBridge;
    }

    /**
     * @param $bucketName
     * @param $fileName
     * @param array $opts
     * @return StorageObject
     */
    public function writeBucket(string $bucketName, string $fileName, $opts = []): StorageObject
    {
        return $this->storageBridge->createClient()->bucket($bucketName)->upload(fopen($fileName, 'r'), $opts);
    }

    public function dl($bucketName, $directory, $fileName)
    {
        return $this->storageBridge->createClient()->bucket($bucketName)->object($directory . $fileName);
    }

    /**
     * @param string $bucketName
     * @param string $directory
     * @param string $fileName
     */
    public function deleteBucket(string $bucketName, string $directory, string $fileName) : void
    {
        $this->storageBridge->createClient()->bucket($bucketName)->object($directory . '/' . $fileName)->delete();
    }
}
