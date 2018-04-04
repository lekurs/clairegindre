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

    public function save(ArticleInterface $article): void;

}