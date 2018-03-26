<?php

namespace App\Entity;

use App\Entity\Interfaces\ArticleInterface;
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
     * @var UserInterface
     */
    private $author;

    /**
     * @var \ArrayAccess
     */
    private $categories;

    /**
     * @var \ArrayAccess
     */
    private $reviews;

    /**
     * @var \ArrayAccess
     */
    private $images;
}
