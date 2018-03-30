<?php

namespace App\Entity;

use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\GalleryInterface;
use App\Entity\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

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



    public function __construct()
    {
        $this->id = Uuid::uuid4();
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
    public function setBenefit(BenefitInterface $benefit): void
    {
        $this->benefit = $benefit;
    }

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param Picture $picture
     */
    public function setPictures(Picture $picture): void
    {
        $this->pictures[] = $picture;

        $picture->setPicture($this);
    }
}
