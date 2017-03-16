<?php

namespace Hellcat\TwitchApiBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use JMS\Serializer\Serializer;
use Hellcat\TwitchApiBundle\Twitch as TwitchApi;
use Hellcat\TwitchApiBundle\Model\Factory as ModelFactory;
use Hellcat\TwitchApiBundle\Entity\TwitchUser;
use Hellcat\TwitchApiBundle\Model\Twitch\User\User as TwitchUserData;

/**
 * Class Auth
 * @package Hellcat\TwitchApiBundle\Service
 */
class Auth
{
    /**
     * @var TwitchApi\Api\Factory
     */
    private $twitchApi;

    /**
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Auth constructor.
     * @param TwitchApi\Twitch $twitchApi
     * @param ModelFactory $modelFactory
     * @param DoctrineRegistry $doctrine
     * @param Serializer $serializer
     */
    public function __construct(
        TwitchApi\Twitch $twitchApi,
        ModelFactory $modelFactory,
        DoctrineRegistry $doctrine,
        Serializer $serializer
    )
    {
        $this->twitchApi = $twitchApi->api();
        $this->modelFactory = $modelFactory;
        $this->doctrine = $doctrine;
        $this->serializer = $serializer;
    }

    /**
     * Begin authentication process with Twitch.
     *
     * To start authentication / get an OAuth token first call this method.
     * Pass it the local URL (that **must** also be registered for your app at Twitch!) to which Twitch will redirect
     * back and pass the authentication code to.
     *
     * This function returns an URL at the Twitch API you need to redirect the user to, for getting the auth-code back
     * from Twitch.
     *
     * @param string $localAuthUrl
     * @return string
     */
    public function init($localAuthUrl)
    {
        return $this->twitchApi->auth()->init($localAuthUrl);
    }

    /**
     * Call this method after being sent back from Twitch after the init() call.
     *
     * It will fetch the actual OAuth token from Twitch and store all relevant Twitch user data into the
     * database.
     * You can (optionally) specify your local user ID of the user to have it associated with the Twitch
     * user data, so can request the Twitch user data later using your local/own user ID,
     * Alternatively you can handle the association yourself with the ID or Twitch user ID from the user data record
     * returned by this call.
     *
     * This method will also return a full data set of the Twitch user (given the Twitch scopes are sufficient).
     *
     * @param string $code
     * @param string $localAuthUrl
     * @param string $localUserId
     * @return TwitchUserData
     */
    public function fetchToken($code, $localAuthUrl, $localUserId = '')
    {
        $twitchToken = $this->twitchApi->auth()->fetchToken($code, $localAuthUrl);
        $twitchUserData = $this->twitchApi->auth()->getUserData($twitchToken->getAccessToken());

        $dbManager = $this->doctrine->getManager();
        $user = $dbManager->getRepository(TwitchUser::class)->findOneBy(
            [
                'twitchUserId' => $twitchUserData->getUserId()
            ]
        );
        if (null === $user) {
            $user = new TwitchUser();
            $user->setCreated((string)time());
        }

        $user->setTwitchUserId($twitchUserData->getUserId());
        $user->setLocalUserId($localUserId);
        $user->setDisplayName($twitchUserData->getDisplayName());
        $user->setChannel(strtolower($twitchUserData->getDisplayName()));
        $user->setOauthToken($twitchToken->getAccessToken());
        $user->setOauthRefreshToken($twitchToken->getRefreshToken());
        $user->setScope(serialize($twitchToken->getScope()));
        $user->setLastLogin((string)time());
        $dbManager->persist($user);
        $dbManager->flush();

        return $twitchUserData;
    }
}
