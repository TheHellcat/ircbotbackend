<?php

namespace Hellcat\Tools\UserBundle\Model\User;

/**
 * Class Factory
 * @package Hellcat\Tools\UserBundle\Model\User
 */
class Factory
{
    /**
     * @return User
     */
    public function user()
    {
        return new User();
    }
}
