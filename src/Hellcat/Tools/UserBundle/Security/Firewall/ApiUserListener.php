<?php

namespace Hellcat\Tools\UserBundle\Security\Firewall;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\ApiUserToken as UserToken;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Service\Security\ListenerHelper;
use Hellcat\Tools\UserBundle\Security\Constants;

/**
 * Class Listener
 * @package Hellcat\Tools\UserBundle\Security\Firewall
 */
class ApiUserListener implements ListenerInterface
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
     * @param EntityFactory $entities
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $authenticationManager,
        ListenerHelper $helper
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->helper = $helper;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $token = new UserToken();

        $token->setUser($request->headers->get(Constants::FIELD_HEADER_API_ID, ''));
        $token->setApiToken($request->headers->get(Constants::FIELD_HEADER_API_APITOKEN, ''));
        $token->setUserName($request->headers->get(Constants::FIELD_HEADER_API_ID, ''));
        $token->setAuthHashInRequest($request->headers->get(Constants::FIELD_HEADER_API_AUTH, ''));

        try {
            $token->setAuthHashGenerated(
                $this->helper->generateApiRequestHash(
                    $request,
                    $this->helper->getApiUserSecret(
                        $token->getUsername(),
                        $token->getApiToken()
                    )
                )
            );

            $authToken = $this->authenticationManager->authenticate($token);
            $this->helper->updateLogin($authToken->getUser(), '', '', true);
            $this->tokenStorage->setToken($authToken);
            return;
        } catch (AuthenticationException $failed) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof UserToken) {
                $this->tokenStorage->setToken(null);
            }
        }

        $event->setResponse($this->helper->getSimple403Response());
    }
}
