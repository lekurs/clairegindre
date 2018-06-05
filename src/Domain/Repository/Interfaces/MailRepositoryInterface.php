<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 16:54
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Models\Mail;

interface MailRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param Mail $mail
     */
    public function save(Mail $mail):void;
}