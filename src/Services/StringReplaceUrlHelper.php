<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 08/05/2018
 * Time: 21:24
 */

namespace App\Services;

use \Transliterator;
final class StringReplaceUrlHelper
{

//    /**
//     * @var Transliterator
//     */
//    private $transliterator;
//
//    /**
//     * StringReplaceUrlHelper constructor.
//     * @param Transliterator $transliterator
//     */
//    public function __construct(Transliterator $transliterator)
//    {
//        $this->transliterator = $transliterator;
//    }

    /**
     * @param $string
     * @return string
     */
    public function replace($string)
    {
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
        $string = preg_replace('/[-\s]+/', '-', $string);

        return trim($string, '-');
    }
}
