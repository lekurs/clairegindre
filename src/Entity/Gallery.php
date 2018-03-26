<?php

namespace App\Entity;

use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;

class Gallery implements GalleryInterface
{
    private $id;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var BenefitInterface
     */
    private $benefit;

    /**
     * @var \ArrayAccess
     */
    private $pictures;

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
