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
    public function writeBucket($bucketName, $fileName, $opts = []): StorageObject
    {
        return $this->storageBridge->createClient()->bucket($bucketName)->upload(fopen($fileName, 'r'), $opts);
    }

    public function deleteBucket($bucketName) : void
    {
        $this->storageBridge->createClient()->bucket($bucketName)->delete();
    }
}
