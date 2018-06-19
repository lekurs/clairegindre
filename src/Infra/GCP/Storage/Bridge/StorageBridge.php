<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 18/06/2018
 * Time: 14:19
 */

namespace App\Infra\GCP\Storage\Bridge;


use App\Infra\GCP\Storage\Bridge\Interfaces\StorageBridgeInterface;
use Google\Cloud\Storage\StorageClient;

final class StorageBridge implements StorageBridgeInterface
{
    /**
     * @var string
     */
    private $credentialsFileName;

    /**
     * @var string
     */
    private $credentialsFolder;

    /**
     * StorageBridge constructor.
     *
     * @param string $credentialsFileName
     * @param string $credentialsFolder
     */
    public function __construct(string $credentialsFileName, string $credentialsFolder)
    {
        $this->credentialsFileName = $credentialsFileName;
        $this->credentialsFolder = $credentialsFolder;
    }

    public function createClient(): StorageClient
    {
        $credentialsFolder = str_replace('\\', '/', $this->credentialsFolder);

        return new StorageClient([
            'keyFile' => json_decode(
               file_get_contents($credentialsFolder . '/' . $this->credentialsFileName),
               true
            )
        ]);
    }
}
