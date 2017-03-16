<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

use Hellcat\TwitchApiBundle\Model\Twitch\Auth\Token;
use Hellcat\TwitchApiBundle\Model\Twitch\User\User as UserModel;

/**
 * Class Auth
 * @package Hellcat\TwitchApiBundle\Twitch\Api
 */
class Auth extends ApiBaseClass
{
    /**
     * @var string
     */
    private $state;


    /**
     * First thing to be called to authenticate a user with Twitch.
     *
     * This function returns an URL the user needs to be redirected to (via "return $this->redirect(...);" in the
     * controller) to get an auth code from the API that can then be used fetch the oauth token (via ::fetchToken())
     *
     * The Twitch API will redirect back to your registered URL with a "code=" parameter, pass this code to
     * ::fetchToken to retrieve the actual oauth token required to authenticate privileged API calls.
     *
     * IMPORTANT: The $redirectUrl *must* match with the URL registered for the app at Twitch, or the API will
     * return an error and authentication will fail!
     *
     * @param string $redirectUrl
     * @return string
     */
    public function init($redirectUrl)
    {
        $this->state = md5(time());

        $apiCall = '/oauth2/authorize';

        $scopes = [
            'user_read',
            'user_blocks_edit',
            'user_blocks_read',
            'channel_read',
            'channel_editor',
            'channel_commercial',
            'channel_subscriptions',
            'channel_check_subscription',
            'chat_login'
        ];

        $query = [
            'response_type' => 'code',
            'client_id' => $this->config->getClientId(),
            'redirect_uri' => $redirectUrl,
            'scope' => implode(' ', $scopes),
            'state' => $this->state,
            'force_verify' => 'false'
        ];

        return $this->config->getApiEndpoint() . $apiCall . '?' . http_build_query($query);
    }

    /**
     * This function fetches the actual oauth token from the Twitch API after getting the auth code from the
     * initial auth API call
     *
     * IMPORTANT: The $redirectUrl *must* match with the URL registered for the app at Twitch, or the API will
     * return an error and authentication will fail!
     *
     * @param string $code
     * @param string $redirectUrl
     * @return Token
     */
    public function fetchToken($code, $redirectUrl)
    {
        $query = [
            'client_id' => $this->config->getClientId(),
            'client_secret' => $this->config->getClientSecret(),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectUrl,
            'code' => $code,
            'state' => $this->state
        ];

        $twitchResponse = $this->httpClient->post(
            $this->config->getApiEndpoint() . '/oauth2/token',
            [
                'body' => http_build_query($query)
            ]
        );

        $responseContents = $twitchResponse->getBody()->getContents();

        return $this->serializer->deserialize($responseContents, Token::class, 'json');
    }

    /**
     * Get detailed information about user authenticated with the given OAuth token
     *
     * @param string $oauthToken
     * @return UserModel
     */
    public function getUserData($oauthToken)
    {
        $userJson = $this->commHelper->callTwitchApi('/user', 'GET', $oauthToken);
        return $this->serializer->deserialize($userJson, UserModel::class, 'json');
    }
}
