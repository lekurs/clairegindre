<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 08/05/2018
 * Time: 21:24
 */

namespace App\Services;

use App\Services\Interfaces\SlugHelperInterface;

final class SlugHelper implements SlugHelperInterface
{
    /**
     * @param $desi
     * @return mixed|string
     */
    function replace($desi)
    {
        $transliterator = \Transliterator::createFromRules("::Latin-ASCII; ::Lower; [^[:L:][:N:]]+ > '-';");

        $value = trim($transliterator->transliterate($desi), '-');

        return $value;
    }
}
