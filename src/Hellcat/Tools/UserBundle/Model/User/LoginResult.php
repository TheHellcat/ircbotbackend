<?php

namespace Hellcat\Tools\UserBundle\Model\User;

/**
 * Class LoginResult
 * @package Hellcat\Tools\UserBundle\Model\User
 */
class LoginResult
{
    /**
     * @var boolean
     */
    private $success;

    /**
     * @var string
     */
    private $message;

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return LoginResult
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return LoginResult
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
