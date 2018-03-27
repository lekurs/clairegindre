<?php

namespace App\Entity;

use App\Entity\Interfaces\BenefitInterface;
use App\Entity\Interfaces\CategoryInterface;
use App\Entity\Interfaces\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;


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

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return \ArrayAccess
     */
    public function getGalleries(): \ArrayAccess
    {
        return $this->galleries;
    }

    /**
     * @param \ArrayAccess $galleries
     */
    public function setGalleries(\ArrayAccess $galleries): void
    {
        $this->galleries = $galleries;
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
}
