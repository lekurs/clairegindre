<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 08/05/2018
 * Time: 21:24
 */

namespace App\Services;

final class SlugHelper
{
    function replace($desi)
    {
        $transliterator = \Transliterator::createFromRules("::Latin-ASCII; ::Lower; [^[:L:][:N:]]+ > '-';");

        $value = trim($transliterator->transliterate($desi), '-');

        return $value;
    }
}
