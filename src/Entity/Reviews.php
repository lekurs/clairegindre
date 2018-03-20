<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewsRepository")
 */
class Reviews
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

//    /**
//     * @ORM\Column(type="integer", nullable=true)
//     * @Assert\NotBlank
//     *
//     */
//    private $userId;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *          min = 5,
     *          max = 100,
 *              minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *          maxMessage = "Le nom ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $reviews;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private $online;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Picture", mappedBy="review", cascade={"persist", "remove"})
     */
    private $image;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews): void
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online): void
    {
        $this->online = $online;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Picture $picture
     */
    public function setImage(Picture $picture)
    {
        $this->image = $picture;

        $picture->setReview($this);
    }
}
