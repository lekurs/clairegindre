<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 25/04/2018
 * Time: 11:00
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Interfaces\ReviewsInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

interface ReviewsRepositoryInterface
{
    /**
     * ReviewsRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllOnline();

    /**
     * @param ReviewsInterface $reviews
     * @return mixed
     */
    public function save(ReviewsInterface $reviews);

    /**
     * @param ReviewsInterface $reviews
     * @return mixed
     */
    public function delete(ReviewsInterface $reviews);

}