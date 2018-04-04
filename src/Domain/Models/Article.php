<?php

namespace App\Domain\Models;


use App\Domain\Models\Interfaces\ArticleInterface;
use App\Domain\Models\Interfaces\GalleryInterface;
use App\Domain\Models\Interfaces\UserInterface;
use ArrayAccess;
use Doctrine\ORM\Mapping as ORM;

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
}
