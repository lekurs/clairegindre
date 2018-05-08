<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 08/05/2018
 * Time: 21:24
 */

namespace App\Services;


class StringReplaceUrlService
{
    public function replace($url)
    {
        $search = [
            '-',
            '_',
            '&',
            'é',
            'è',
            'à',

        ];

        $replace = [
           ' ',
           '\'\'',
           '-',
           'e',
           'e',
           'a'
        ];
        strtolower(str_replace($search, $replace, $url));
    }

}