<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 10:30
 */

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ReviewsInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints\DateTime;

class Reviews implements ReviewsInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var UserInterface
     */
    private $author;

    /**
     * @var string
     */
    private $imagePath;

    /**
     * @var string
     */
    private $imageName;

    /**
     * Reviews constructor.
     *
     * @param string $id
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param UserInterface $author
     * @param string $imagePath
     * @param string $imageName
     */
    public function __construct(
        string $title,
        string $content,
        \DateTime $creationDate,
        UserInterface $author,
        string $imagePath,
        string $imageName
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->content = $content;
        $this->creationDate = new DateTime();
        $this->author = $author;
        $this->imagePath = $imagePath;
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->imageName;
    }
}
