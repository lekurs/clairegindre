<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/04/2018
 * Time: 17:32
 */

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\ArticleInterface;

interface ArticleRepositoryInterface
{
    /**
     * @param $slug
     * @return mixed
     */
    public function getOne($slug);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param ArticleInterface $article
     */
    public function save(ArticleInterface $article): void;

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param ArticleInterface $article
     */
    public function delete(ArticleInterface $article): void;

}