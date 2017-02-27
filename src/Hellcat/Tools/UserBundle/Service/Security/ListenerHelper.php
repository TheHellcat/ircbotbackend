<?php

namespace Hellcat\Tools\UserBundle\Service\Security;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Security\User\User as User;
use Hellcat\Tools\UserBundle\Entity\User\UserApiTokenAssign as TokenAssignEntity;
use Hellcat\Tools\UserBundle\Entity\User\UserApiToken as TokenEntity;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;
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
     * @param Request $request
     * @param $clientSecret
     * @return string
     */
    public function generateApiRequestHash(Request $request, $clientSecret)
    {
        $requestHash = '';
        if (strlen($clientSecret) > 1) {
            $periodLength = 90;
            $timePeriod = (int)((time() - ($periodLength / 2)) / $periodLength);
            $hashStr = $request->getUri() . $request->getContent() . $timePeriod . $clientSecret;
            $requestHash = hash('sha512', $hashStr);
        } else {
            throw new AuthenticationException('Empty client secret, that usually doesn\'t mean good things.');
        }

        return $requestHash;
    }

    /**
     * @param string $username
     * @param string $apitoken
     * @return string
     */
    public function getApiUserSecret($username, $apitoken)
    {
        $dbUser = $this->doctrine->getManager()->getRepository(UserEntity::class);
        $dbToken = $this->doctrine->getManager()->getRepository(TokenEntity::class);
        $dbTokenAssign = $this->doctrine->getManager()->getRepository(TokenAssignEntity::class);

        $user = $dbUser->findOneBy(
            [
                'username' => $username
            ]
        );

        $token = $dbToken->findOneBy(
            [
                'tokenIdentifier' => $apitoken
            ]
        );

        $userSecret = '';
        if ((null !== $user) && (null !== $token)) {
            $assign = $dbTokenAssign->findOneBy(
                [
                    'userId' => $user->getUserId(),
                    'tokenId' => $token->getTokenId()
                ]
            );
            $userSecret = $assign->getSecret();
        } else {
            throw new AuthenticationException('No API secret found for user.');
        }

        return $userSecret;
    }

    /**
     * @param User $user
     * @param string $verifyHash
     * @param string $remember
     */
    public function updateLogin(User $user, $verifyHash, $remember, $skipTokenUpdate = false)
    {
        $user->getUserEntity()->setLastLogin((string)time());
        $this->doctrine->getManager()->persist($user->getUserEntity());
        $user->setUserEntity(null);

        $userLoginToken = null;
        if (!$skipTokenUpdate) {
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
        }

        $this->doctrine->getManager()->flush();

        if (null !== $userLoginToken) {
            $this->session->set(Constants::FIELD_SESSION_LOGINTOKEN, $userLoginToken->getToken());
        }
    }

    /**
     * @return RedirectResponse
     */
    public function getRedirectResponse()
    {
        return new RedirectResponse($this->configuration->getNoAuthRedirUrl(), 302);
    }
}
