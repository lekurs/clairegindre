<?php

namespace App\Entity;

use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\CategoryInterface;
use App\Entity\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;


class Benefit implements BenefitInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CategoryInterface
     */
    private $category;

    /**
     * @var \ArrayAccess
     */
    private $galleries;

    /**
     * @var UserInterface
     */
    private $user;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Benefit $benefit
     */
    public function setGallery($benefit): void
    {
        $this->gallery = $benefit;
    }

    public function __toString()
    {
        return $this->name;
    }
}
