<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 30/04/2018
 * Time: 23:28
 */

namespace App\Domain\DTO;


use App\Domain\DTO\Interfaces\CustomerLoginTypeDTOInterface;

class CustomerLoginTypeDTO implements CustomerLoginTypeDTOInterface
{
    /**
     * @var string
     */
    public $username;

/**
 * @var string
 */
    public $password;

    /**
     * CustomerLoginTypeDTO constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $username,
        string $password
    ) {
        $this->username = $username;
        $this->password = $password;
    }
}
