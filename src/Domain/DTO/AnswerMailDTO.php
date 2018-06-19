<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 20:40
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\AnswerMailDTOInterface;

final class AnswerMailDTO implements AnswerMailDTOInterface
{
    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $title;

    /**
     * AnswerMailDTO constructor.
     *
     * @param string $subject
     * @param string $content
     */
    public function __construct(
        string $subject,
        string $content
    ) {
        $this->subject = $subject;
        $this->content = $content;
    }
}
