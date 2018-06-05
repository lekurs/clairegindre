<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 05/06/2018
 * Time: 10:36
 */

namespace App\Services\Interfaces;


interface SlugHelperInterface
{
    /**
     * @param $desi
     * @return mixed
     */
    function replace($desi);
}