<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 04/06/2018
 * Time: 21:50
 */

namespace App\Services;


class MailerAdminHelper
{
    /**
     * @var string
     */
    private $mailerAdminEmail;

    /**
     * MailerAdminHelper constructor.
     * @param string $mailerAdminEmail
     */
//    public function __construct(string $mailerAdminEmail)
//    {
//        $this->mailerAdminEmail = $mailerAdminEmail;
//    }


    public function getAdmin()
    {
        return $this->mailerAdminEmail;
    }
}
