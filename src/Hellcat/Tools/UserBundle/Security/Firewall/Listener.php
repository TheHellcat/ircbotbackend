<?php

namespace Hellcat\Tools\UserBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\UserToken;
use Hellcat\Tools\UserBundle\Security\User\User;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;

/**
 * Class Listener
 * @package Hellcat\Tools\UserBundle\Security\Firewall
 */
class Listener implements ListenerInterface
{
    const FIELD_LOGIN_USERNAME = 'loginUsername';
    const FIELD_LOGIN_PASSWORD = 'loginPassword';
    const FIELD_SESSION_LOGINTOKEN = 'loginToken';

    protected $tokenStorage;
    protected $authenticationManager;
    protected $doctrine;
    protected $session;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $authenticationManager,
        DoctrineRegistry $doctrine,
        Session $session
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->doctrine = $doctrine;
        $this->session = $session;

        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $userAgent = $request->headers->get('User-Agent', '');
        $verifyHash = md5($userAgent);

        $token = new UserToken();
        if (
            (strtoupper($request->getMethod()) == 'GET')  // FIXME: 'GET' is only for dev'ing, make this 'POST' once it all works
            && ($request->get(self::FIELD_LOGIN_USERNAME, '*') != '*')
            && ($request->get(self::FIELD_LOGIN_PASSWORD, '*') != '*')
        ) {
            $token->setUser($request->get(self::FIELD_LOGIN_USERNAME));
            $token->setUsername($request->get(self::FIELD_LOGIN_USERNAME));
            $token->setPassword($request->get(self::FIELD_LOGIN_PASSWORD));
            $token->setCredentialsSource('LOGIN');
        } elseif ($this->session->has(self::FIELD_SESSION_LOGINTOKEN)) {
            $token->setUser($this->session->get(self::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionLoginToken($this->session->get(self::FIELD_SESSION_LOGINTOKEN));
            $token->setSessionVerifyHash($verifyHash);
            $token->setCredentialsSource('SESSION');
        }

        try {
            $authToken = $this->authenticationManager->authenticate($token);

            /** @var User $user */
            $user = $authToken->getUser();
            $user->getUserEntity()->setLastLogin((string)time());
            $this->doctrine->getManager()->persist($user->getUserEntity());
            $user->setUserEntity(null);

            $dbUserLoginToken = $this->doctrine->getManager()->getRepository(UserLoginTokenEntity::class);
            $userLoginToken = $dbUserLoginToken->findOneBy(
                [
                    'token' => $this->session->get(self::FIELD_SESSION_LOGINTOKEN, '')
                ]
            );
            if (null === $userLoginToken) {
                $userLoginToken = new UserLoginTokenEntity(); // FIXME: create entity manager/factory and get object from there!!!!!!!!!!!!!
            }
            $userLoginToken->setUsername($user->getUsername());
            $userLoginToken->setSessionVerifyHash($verifyHash);
            $userLoginToken->setTtl((string)(time() + 300));  // TODO: make TTL configurable
            $this->doctrine->getManager()->persist($userLoginToken);

            $this->doctrine->getManager()->flush();

            $this->session->set(self::FIELD_SESSION_LOGINTOKEN, $userLoginToken->getToken());

            $this->tokenStorage->setToken($authToken);

            return;
        } catch (AuthenticationException $failed) {
            $token = $this->tokenStorage->getToken();
            if ($token instanceof UserToken) {
                $this->tokenStorage->setToken(null);
            }
        }


        // By default deny authorization
        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        $response->setContent('403 - no no');
        $event->setResponse($response);
    }
}
