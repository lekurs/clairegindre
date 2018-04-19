<?php

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;
use ArrayAccess;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Models(repositoryClass="ArticleRepository")
 */
class Article implements ArticleInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
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
     * @var int
     */
    private $creationDate;

    /**
     * @var int
     */
    private $modificationDate;

    /**
     * @var bool
     */
    private $online;

    /**
     * @var UserInterface
     */
    private $author;

    /**
     * @var ArrayAccess
     */
    private $images;

    /**
     * @var ArrayAccess
     */
    private $comments;

    /**
     * @var GalleryInterface
     */
    private $gallery;

    /**
     * @var string
     */
    private $prestation;

    /**
     * Article constructor.
     *
     * @param string $title
     * @param string $content
     * @param bool $online
     * @param UserInterface $author
     * @param string $prestation
     */
    public function __construct(
        string $title,
        string $content,
        bool $online,
        UserInterface $author,
        string $prestation
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->content = $content;
        $this->creationDate = new \DateTime();
        $this->online = $online;
        $this->author = $author;
        $this->prestation = $prestation;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return ArrayAccess
     */
    public function getImages(): ArrayAccess
    {
        return $this->images;
    }

    /**
     * @param ArrayAccess $images
     */
    public function setImages(ArrayAccess $images): void
    {
        $this->images = $images;
    }

    /**
     * @return ArrayAccess
     */
    public function getComments(): ArrayAccess
    {
        return $this->comments;
    }

    /**
     * @param ArrayAccess $comments
     */
    public function setComments(ArrayAccess $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return GalleryInterface
     */
    public function getGallery(): GalleryInterface
    {
        return $this->gallery;
    }

    /**
     * @param GalleryInterface $gallery
     */
    public function setGallery(GalleryInterface $gallery): void
    {
        $this->gallery = $gallery;
    }



}
