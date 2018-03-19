<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryRepository")
 */
class Gallery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="gallery", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", name="user_id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Benefit", inversedBy="gallery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $benefit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", cascade={"persist"}, mappedBy="gallery")
     */
    private $picture;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        $user->setGallery($this);
    }

    /**
     * @return mixed
     */
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * @param $benefit
     */
    public function setBenefit(Benefit $benefit)
    {
        $this->benefit = $benefit;

        $benefit->setGallery($this);
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Picture $picture
     */
    public function setPicture(Picture $picture): void
    {
        $this->picture = $picture;

        $picture->setPictureName($this);
    }

    public function __toString()
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture)
    {
        if(!$this->picture->contains($picture)) {
            $this->picture->add($picture);
        }
    }

}
