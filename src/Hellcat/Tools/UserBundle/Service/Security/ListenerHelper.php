<?php

namespace Hellcat\Tools\UserBundle\Service\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\User\User;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Model\Configuration;

/**
 * Class ListenerHelper
 * @package Hellcat\Tools\UserBundle\Service\Security
 */
class ListenerHelper
{
    const FIELD_LOGIN_USERNAME = 'loginUsername';
    const FIELD_LOGIN_PASSWORD = 'loginPassword';
    const FIELD_SESSION_LOGINTOKEN = 'loginToken';

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
     * @param User $user
     * @param string $verifyHash
     */
    public function updateLogin(User $user, $verifyHash)
    {
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
            $userLoginToken = $this->entities->user()->userLoginToken();
        }
        $userLoginToken->setUsername($user->getUsername());
        $userLoginToken->setSessionVerifyHash($verifyHash);
        $userLoginToken->setTtl((string)(time() + $this->configuration->getTtl()));
        $this->doctrine->getManager()->persist($userLoginToken);

        $this->doctrine->getManager()->flush();

        $this->session->set(self::FIELD_SESSION_LOGINTOKEN, $userLoginToken->getToken());
    }

    /**
     * @return RedirectResponse
     */
    public function getRedirectResponse()
    {
        return new RedirectResponse($this->configuration->getNoAuthRedirUrl(), 302);
    }
}
