<?php

namespace App\Entity;

use App\Entity\Interfaces\ArticleInterface;
use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ArticleRepository")
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
     * @var \ArrayAccess
     */
    private $images;

    /**
     * @var \ArrayAccess
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
