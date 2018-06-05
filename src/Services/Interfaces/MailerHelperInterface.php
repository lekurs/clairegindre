<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 05/06/2018
 * Time: 10:31
 */

namespace App\Services\Interfaces;


interface MailerHelperInterface
{
    /**
     * @param $subject
     * @param $to
     * @param $from
     * @return mixed
     */
    public function sendEmail($subject, $to, $from);

    /**
     * @param $subject
     * @param $to
     * @param $from
     * @return mixed
     */
    public function sendConfirmation($subject, $to, $from);

    /**
     * @param $subject
     * @param $to
     * @param $from
     * @param $content
     * @return mixed
     */
    public function sendResponse($subject, $to, $from, $content);
}
