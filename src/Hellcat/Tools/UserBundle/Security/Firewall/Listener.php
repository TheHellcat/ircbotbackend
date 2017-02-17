<?php

namespace Hellcat\Tools\UserBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\UserToken;
use Hellcat\Tools\UserBundle\Security\User\User;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Service\Security\ListenerHelper;

/**
 * Class Listener
 * @package Hellcat\Tools\UserBundle\Security\Firewall
 */
class Listener implements ListenerInterface
{
    const FIELD_LOGIN_USERNAME = 'loginUsername';
    const FIELD_LOGIN_PASSWORD = 'loginPassword';
    const FIELD_LOGIN_REMEMBERME = 'loginRememberme';
    const FIELD_SESSION_LOGINTOKEN = 'loginToken';

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var ListenerHelper
     */
    protected $helper;

    /**
     * Listener constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AuthenticationManagerInterface $authenticationManager
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     * @param EntityFactory $entities
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $authenticationManager,
        Session $session,
        ListenerHelper $helper
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->session = $session;
        $this->helper = $helper;

        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }

    /**
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $verifyHash = $this->helper->generateSessionVerifyHash($request);
        $token = new UserToken();

        if( $request->cookies->has(self::FIELD_LOGIN_REMEMBERME) ) {
            $this->session->set(self::FIELD_SESSION_LOGINTOKEN, $request->cookies->get(self::FIELD_LOGIN_REMEMBERME));
        }

//        if (
//            (strtoupper($request->getMethod()) == 'GET')  // FIXME: 'GET' is only for dev'ing, make this 'POST' once it all works
//            && ($request->get(self::FIELD_LOGIN_USERNAME, '*') != '*')
//            && ($request->get(self::FIELD_LOGIN_PASSWORD, '*') != '*')
//        ) {
//            $token->setUser($request->get(self::FIELD_LOGIN_USERNAME));
//            $token->setUsername($request->get(self::FIELD_LOGIN_USERNAME));
//            $token->setPassword($request->get(self::FIELD_LOGIN_PASSWORD));
//            $token->setCredentialsSource('LOGIN');
//        } else
        if ($this->session->has(self::FIELD_SESSION_LOGINTOKEN)) {
            $token->setUser($this->session->get(self::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionLoginToken($this->session->get(self::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionVerifyHash($verifyHash);
            $token->setCredentialsSource('SESSION');
        }

        try {
            $authToken = $this->authenticationManager->authenticate($token);
            $this->helper->updateLogin($authToken->getUser(), $verifyHash, $request->get(self::FIELD_LOGIN_REMEMBERME, '0'));
            $this->tokenStorage->setToken($authToken);
            return;
        } catch (AuthenticationException $failed) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof UserToken) {
                $this->tokenStorage->setToken(null);
            }
        }


        // By default deny authorization
//        $response = new Response();
//        $response->setStatusCode(Response::HTTP_FORBIDDEN);
//        $response->setContent('403 - no no');
//        $event->setResponse($response);
        $event->setResponse($this->helper->getRedirectResponse());
    }
}
