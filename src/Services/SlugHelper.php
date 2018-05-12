<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 08/05/2018
 * Time: 21:24
 */

namespace App\Services;

use \Transliterator;
final class SlugHelper
{
    function replace($desi)
    {
        $transliterator = \Transliterator::createFromRules("::Latin-ASCII; ::Lower; [^[:L:][:N:]]+ > '-';");

        $value = trim($transliterator->transliterate($desi), '-');


        return $value;
    }
//
//    /**
//     * @param $string
//     * @return string
//     */
//    public function replace($string)
//    {
//        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
//        $string = preg_replace('/[-\s]+/', '-', $string);
//
//        return trim($string, '-');
//    }
}
