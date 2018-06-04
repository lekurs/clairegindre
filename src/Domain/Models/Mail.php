<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:06
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\MailInterface;
use Ramsey\Uuid\Uuid;

class Mail implements MailInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $isAnswered;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * Mail constructor.
     *
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $content
     * @param bool $isAnswered
     * @param string $slug
     * @param MailInterface $mail
     */
    public function __construct(
        string $from,
        string $to,
        string $subject,
        string $content,
        bool $isAnswered,
        string $slug,
        MailInterface $mail
    ) {
        $this->id = Uuid::uuid4();
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->content = $content;
        $this->isAnswered = $isAnswered;
        $this->slug = $slug;
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isAnswered(): bool
    {
        return $this->isAnswered;
    }

    /**
     * @return MailInterface
     */
    public function getMail(): MailInterface
    {
        return $this->mail;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

//    public function answerTo(AnswerMailDTOInterface $mailDTO)
//    {
//        //from - content - subject
//    }
}
