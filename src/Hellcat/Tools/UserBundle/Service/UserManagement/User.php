<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Provider\Provider as AuthenticationProvider;
use Hellcat\Tools\UserBundle\Service\Security\ListenerHelper;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\UserToken;
use Hellcat\Tools\UserBundle\Model\Factory as ModelFactory;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;

/**
 * Class User
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
class User extends UserManagementBase
{
    const FIELD_LOGIN_USERNAME = 'loginUsername';
    const FIELD_LOGIN_PASSWORD = 'loginPassword';
    const FIELD_LOGIN_REMEMBERME = 'loginRememberme';
    const FIELD_SESSION_LOGINTOKEN = 'loginToken';

    private $authProvider;

    private $fwListenerHelper;

    private $modelFactory;

    public function __construct(
        DoctrineRegistry $doctrine,
        Session $session,
        AuthenticationProvider $authProvider,
        ListenerHelper $fwListenerHelper,
        ModelFactory $modelFactory
    )
    {
        parent::__construct($doctrine, $session);

        $this->authProvider = $authProvider;
        $this->fwListenerHelper = $fwListenerHelper;
        $this->modelFactory = $modelFactory;
    }

    public function register($username, $password)
    {
    }

    public function login($username, $password, $remember, Request $request, Response $response)
    {
        $token = new UserToken();
        $token->setUser($username);
        $token->setUsername($username);
        $token->setPassword($password);
        $token->setCredentialsSource('LOGIN');

        $result = $this->modelFactory->user()->loginResult();
        try {
            $authToken = $this->authProvider->authenticate($token);
            $this->fwListenerHelper->updateLogin($authToken->getUser(), $this->fwListenerHelper->generateSessionVerifyHash($request), $remember);
            $result
                ->setSuccess(true)
                ->setMessage('OK');

            if ('REMEMBER' == $remember) {
                $dbUserLoginToken = $this->doctrine->getManager()->getRepository(UserLoginTokenEntity::class);
                $userLoginToken = $dbUserLoginToken->findOneBy(
                    [
                        'token' => $this->session->get(self::FIELD_SESSION_LOGINTOKEN, '')
                    ]
                );
                if( null !== $userLoginToken  ) {
                    $cookie = new Cookie(self::FIELD_LOGIN_REMEMBERME, $userLoginToken->getToken(), time() + 90, '/', null, false, true, false, null);
                    $response->headers->setCookie($cookie);
                }
            }
        } catch (\Exception $exception) {
            $result
                ->setSuccess(false)
                ->setMessage($exception->getMessage());
        }

        return $result;
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function logout(Request $request, Response $response)
    {
        $this->session->clear();
        $this->session->invalidate();
        $response->headers->clearCookie('loginRememberme');
    }
}
