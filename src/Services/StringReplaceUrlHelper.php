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
     * @param $url
     * @return string
     */
    public function replace($url)
    {
        \Transliterator::createFromRules("::Latin-ASCII; ::Lower; [^[:L:][:N:]]+ > '-';");
//        $this->transliterator->createFromRules();

//        $result =
//$this->transliterator->transliterate($url, '-');
        return \Transliterator::translirate($url, '-');
    }
}
