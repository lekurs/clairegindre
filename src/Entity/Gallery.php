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
     */
    private $benefit;

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
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBenefit()
    {
        return $this->benefit;
    }

    /**
     * @param Benefit $benefit
     * @return $this
     */
    public function setBenefit(Benefit $benefit)
    {
        $this->benefit = $benefit;

        return $this;
    }


}
