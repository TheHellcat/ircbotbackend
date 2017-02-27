<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\Authentication\Provider\LoginUserProvider as AuthenticationProvider;
use Hellcat\Tools\UserBundle\Service\Security\ListenerHelper;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\LoginUserToken as UserToken;
use Hellcat\Tools\UserBundle\Model\Factory as ModelFactory;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;
use Hellcat\Tools\UserBundle\Security\Constants;
use Hellcat\Tools\UserBundle\Model\User\CommonResult;

/**
 * Class User
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
class User extends UserManagementBase
{
    /**
     * @var AuthenticationProvider
     */
    private $authProvider;

    /**
     * @var ListenerHelper
     */
    private $fwListenerHelper;

    /**
     * User constructor.
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     * @param AuthenticationProvider $authProvider
     * @param ListenerHelper $fwListenerHelper
     * @param ModelFactory $modelFactory
     * @param EntityFactory $entityFactory
     */
    public function __construct(
        DoctrineRegistry $doctrine,
        Session $session,
        ModelFactory $modelFactory,
        EntityFactory $entityFactory,
        AuthenticationProvider $authProvider,
        ListenerHelper $fwListenerHelper
    )
    {
        parent::__construct($doctrine, $session, $modelFactory, $entityFactory);

        $this->authProvider = $authProvider;
        $this->fwListenerHelper = $fwListenerHelper;
    }

    /**
     * @param string $identifier
     * @return UserEntity|null
     */
    public function fetchUserRaw($identifier)  // TODO: refactor this into a public:false service
    {
        $dbUser = $this->doctrine->getManager()->getRepository(UserEntity::class);

        // try fetching the user by the name
        $user = $dbUser->findOneBy(
            [
                'username' => $identifier
            ]
        );

        if (null === $user) {
            // if that didn't yield any result, try user ID
            $user = $dbUser->findOneBy(
                [
                    'userId' => $identifier
                ]
            );
        }

        return $user;
    }

    /**
     * @param $username
     * @param $password
     * @return CommonResult
     */
    public function register($username, $password)
    {
        $result = $this->modelFactory->user()->commonResult();

        $user = $this->fetchUserRaw($username);

        if (null === $user) {
            $user = $this->entityFactory->user()->user();
            $user
                ->setUsername($username)
                ->setPassword($password)
                ->setLocked(0)
                ->setLockReason('')
                ->setUserType('USER')
                ->setCreated(time())
                ->setLastLogin(0);
            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $result
                ->setSuccess(true)
                ->setMessage($user->getUserId());
        } else {
            $result
                ->setSuccess(false)
                ->setMessage('User already exists');
        }

        return $result;
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $remember
     * @param Request $request
     * @param Response $response
     * @return CommonResult
     */
    public function login($username, $password, $remember, Request $request, Response $response)
    {
        $token = new UserToken();
        $token->setUser($username);
        $token->setUsername($username);
        $token->setPassword($password);
        $token->setCredentialsSource('LOGIN');

        $result = $this->modelFactory->user()->commonResult();
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
                        'token' => $this->session->get(Constants::FIELD_SESSION_LOGINTOKEN, '')
                    ]
                );
                if (null !== $userLoginToken) {
                    $cookie = new Cookie(Constants::FIELD_LOGIN_REMEMBERME, $userLoginToken->getToken(), time() + 90, '/', null, false, true, false, null);
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
     * @return Response
     */
    public function logout(Request $request, Response $response)
    {
        $this->session->clear();
        $this->session->invalidate();
        $response->headers->clearCookie(Constants::FIELD_LOGIN_REMEMBERME);
        return $response;
    }

    public function lockUser($userId, $reason)
    {
    }

    public function unlockUser($userId)
    {
    }
}
