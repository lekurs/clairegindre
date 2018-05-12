<?php

namespace App\Domain\Models;


use App\Domain\DTO\EditArticleTypeDTO;
use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\BenefitInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\GalleryMakerInterface;
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
     * @var string
     */
    private $slug;

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
     * @var GalleryMakerInterface
     */
    private $galleryMaker;

    /**
     * Article constructor.
     *
     * @param string $title
     * @param string $content
     * @param \DateTime $creationDate
     * @param bool $online
     * @param UserInterface $author
     * @param string $personnalButton
     * @param string $slug
     * @param GalleryInterface $gallery
     * @param BenefitInterface $prestation
     * @param GalleryMakerInterface|null $galleryMaker
     */
    public function __construct(
        string $title,
        string $content,
        \DateTime $creationDate,
        bool $online,
        UserInterface $author,
        string $personnalButton,
        string  $slug,
        GalleryInterface $gallery,
        BenefitInterface $prestation,
        GalleryMakerInterface $galleryMaker = null
    ) {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->content = $content;
        $this->creationDate = new \DateTime();
        $this->online = $online;
        $this->author = $author;
        $this->personnalButton = $personnalButton;
        $this->slug = $slug;
        $this->gallery = $gallery;
        $this->prestation = $prestation;
        $this->galleryMaker = $galleryMaker;
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
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
     * @return GalleryInterface
     */
    public function getGallery(): GalleryInterface
    {
        return $this->gallery;
    }

    /**
     * @return string
     */
    public function getPersonnalButton(): string
    {
        return $this->personnalButton;
    }

    /**
     * @return GalleryMakerInterface
     */
    public function getGalleryMaker(): GalleryMakerInterface
    {
        return $this->galleryMaker;
    }

    /**
     * @param ArrayAccess $comments
     */
    public function setComments(ArrayAccess $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @param GalleryInterface $gallery
     */
    public function setGallery(GalleryInterface $gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @param EditArticleTypeDTO $dto
     */
    public function updateArticle(EditArticleTypeDTO $dto)
    {
        $this->title = $dto->title;
        $this->content = $dto->content;
        $this->personnalButton = $dto->personnalButton;
        $this->prestation = $dto->prestation;
        $this->slug = $dto->title;
    }
}
