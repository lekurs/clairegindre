<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:28
 */

namespace App\Infra\GCP\Storage\Bridge\Interfaces;


use Google\Cloud\Storage\StorageClient;

interface StorageBridgeInterface
{
    /**
     * StorageBridgeInterface constructor.
     *
     * @param string $credentialsFileName
     * @param string $credentialsFolder
     */
    public function __construct(string $credentialsFileName, string $credentialsFolder);

    /**
     * @return StorageClient
     */
    public function createClient(): StorageClient;
}
