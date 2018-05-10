<?php

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\GalleryPageInterface;
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
     * @var \DateTime
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
     * @var string
     */
    private $personnalButton;

    /**
     * @var ArrayAccess
     */
    private $comments;

    /**
     * @var GalleryInterface
     */
    private $gallery;

    /**
     * @var BenefitInterface
     */
    private $prestation;

    /**
     * @var GalleryPageInterface
     */
    private $galleryPages;

    /**
     * Article constructor.
     *
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param bool $online
     * @param UserInterface $author
     * @param string $personnalButton
     * @param GalleryInterface $gallery
     * @param BenefitInterface $prestation
     * @param GalleryPageInterface|null $galleryPages
     */
    public function __construct(
        string $title,
        string $content,
        \DateTime $creationDate,
        bool $online,
        UserInterface $author,
        string $personnalButton,
        GalleryInterface $gallery,
        BenefitInterface $prestation,
        GalleryPageInterface $galleryPages = null
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->content = $content;
        $this->creationDate = new \DateTime();
        $this->online = $online;
        $this->author = $author;
        $this->personnalButton = $personnalButton;
        $this->gallery = $gallery;
        $this->prestation = $prestation;
        $this->galleryPages = $galleryPages;
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
     * @return int
     */
    public function getModificationDate(): int
    {
        return $this->modificationDate;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface
    {
        return $this->author;
    }

    /**
     * @return BenefitInterface
     */
    public function getPrestation(): BenefitInterface
    {
        return $this->prestation;
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

    /**
     * @return string
     */
    public function getPersonnalButton(): string
    {
        return $this->personnalButton;
    }

    /**
     * @return GalleryPageInterface
     */
    public function getGalleryPages(): GalleryPageInterface
    {
        return $this->galleryPages;
    }
}
