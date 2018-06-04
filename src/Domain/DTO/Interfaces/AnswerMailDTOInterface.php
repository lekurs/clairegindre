<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:41
 */

namespace App\Domain\DTO\Interfaces;


interface AnswerMailDTOInterface
{
    /**
     * AnswerMailDTOInterface constructor.
     *
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $content
     */
    public function __construct(
        string $subject,
        string $from,
        string $to,
        string $content
    );
}