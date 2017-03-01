<?php

namespace Hellcat\Tools\UserBundle\Security\Firewall;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\LoginUserToken as UserToken;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Service\Security\ListenerHelper;
use Hellcat\Tools\UserBundle\Security\Constants;

/**
 * Class Listener
 * @package Hellcat\Tools\UserBundle\Security\Firewall
 */
class LoginUserListener implements ListenerInterface
{
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

        if( $request->cookies->has(Constants::FIELD_LOGIN_REMEMBERME) ) {
            $this->session->set(Constants::FIELD_SESSION_LOGINTOKEN, $request->cookies->get(Constants::FIELD_LOGIN_REMEMBERME));
        }

        if ($this->session->has(Constants::FIELD_SESSION_LOGINTOKEN)) {
            $token->setUser($this->session->get(Constants::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionLoginToken($this->session->get(Constants::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionVerifyHash($verifyHash);
            $token->setCredentialsSource('SESSION');
        }

        try {
            $authToken = $this->authenticationManager->authenticate($token);
            $this->helper->updateLogin($authToken->getUser(), $verifyHash, $request->get(Constants::FIELD_LOGIN_REMEMBERME, '0'));
            $this->tokenStorage->setToken($authToken);
            return;
        } catch (AuthenticationException $failed) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof UserToken) {
                $this->tokenStorage->setToken(null);
            }
        }

        $event->setResponse($this->helper->getRedirectResponse());
    }
}
