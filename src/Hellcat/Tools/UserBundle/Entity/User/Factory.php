<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

/**
 * Class Factory
 * @package Hellcat\Tools\UserBundle\Entity\User
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

    /**
     * @return UserAcl
     */
    public function userAcl()
    {
        return new UserAcl();
    }

    /**
     * @return UserLoginToken
     */
    public function userLoginToken()
    {
        return new UserLoginToken();
    }

    /**
     * @return UserRole
     */
    public function userRole()
    {
        return new UserRole();
    }
}
