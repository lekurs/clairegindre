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
     * @param $bucketName
     * @param $fileName
     * @param array $opts
     * @return StorageObject
     */
    public function writeBucket($bucketName, $fileName, $opts = []): StorageObject;
}
