<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 01/02/2018
 * Time: 20:40
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InstagramController extends Controller
{
    private $token = '7848828.8164d1d.64d97923593041f2883c257a3f8e1884';

    public function show()
    {
        $limit = 6;
        $endpoint = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$this->token.'&count='.$limit;

        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $media = json_decode(curl_exec($curl));

        if($media->meta->code == 200)
        {
            $json = $media->data;
        }
        return $json;
    }

}