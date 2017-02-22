<?php

namespace Hellcat\Tools\UserBundle\Service\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\User\LoginUser as User;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Model\Configuration;
use Hellcat\Tools\UserBundle\Security\Constants;

/**
 * Class ListenerHelper
 * @package Hellcat\Tools\UserBundle\Service\Security
 */
class ListenerHelper
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var EntityFactory
     */
    private $entities;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * ListenerHelper constructor.
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     * @param EntityFactory $entities
     * @param Configuration $configuration
     */
    public function __construct(
        DoctrineRegistry $doctrine,
        Session $session,
        EntityFactory $entities,
        Configuration $configuration
    )
    {
        $this->doctrine = $doctrine;
        $this->session = $session;
        $this->entities = $entities;
        $this->configuration = $configuration;

        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function generateSessionVerifyHash(Request $request)
    {
        $userAgent = $request->headers->get('User-Agent', '');
        return md5($userAgent);
    }

    /**
     * @param User $user
     * @param string $verifyHash
     * @param string $remember
     */
    public function updateLogin(User $user, $verifyHash, $remember)
    {
        $user->getUserEntity()->setLastLogin((string)time());
        $this->doctrine->getManager()->persist($user->getUserEntity());
        $user->setUserEntity(null);

        $dbUserLoginToken = $this->doctrine->getManager()->getRepository(UserLoginTokenEntity::class);
        $userLoginToken = $dbUserLoginToken->findOneBy(
            [
                'token' => $this->session->get(Constants::FIELD_SESSION_LOGINTOKEN, '')
            ]
        );
        if (null === $userLoginToken) {
            $userLoginToken = $this->entities->user()->userLoginToken();
        }
        $userLoginToken->setUsername($user->getUsername());
        $userLoginToken->setSessionVerifyHash($verifyHash);
        $userLoginToken->setTtl((string)(time() + $this->configuration->getTtl()));
        $this->doctrine->getManager()->persist($userLoginToken);

        $this->doctrine->getManager()->flush();

        $this->session->set(Constants::FIELD_SESSION_LOGINTOKEN, $userLoginToken->getToken());
    }

    /**
     * @return RedirectResponse
     */
    public function getRedirectResponse()
    {
        return new RedirectResponse($this->configuration->getNoAuthRedirUrl(), 302);
    }
}
