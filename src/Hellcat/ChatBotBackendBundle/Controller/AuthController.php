<?php

namespace Hellcat\ChatBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hellcat\Tools\UserBundle\Security\User\User as LocalUser;
use Hellcat\ChatBotBackendBundle\Exception\InvalidStateException;

/**
 * Class AuthController
 * @package Hellcat\ChatBotBackendBundle\Controller
 */
class AuthController extends Controller
{
    /**
     * @Route("/twitch", name="botbackend_auth_twitch")
     * @Template()
     */
    public function twitchAction(Request $request)
    {
        /** @var LocalUser $localUser */
        $localUser = $this->getUser();
        $twitchAuth = $this->get('hellcat_twitch_authhandler');

        if (!($localUser instanceof LocalUser)) {
            throw new InvalidStateException('Must be logged in locally for Twitch authentication!');
        }

        $redirUrl = 'http://live.hellcat.net/twitch-manager/auth.php'; //$this->generateUrl('twitch_auth');

        if ($request->query->has('code')) {
            $twitchAuth->fetchToken($request->query->get('code', ''), $redirUrl, $localUser->getUserId());
            return $this->redirect($this->generateUrl('botbackend_user_dashboard'));
        } else if ($request->query->has('error')) {
            $isError = true;
            $errorMessage = $request->query->has('error_description');
        } else {
            return $this->redirect($twitchAuth->init($redirUrl));
        }

        return [
            'isError' => $isError,
            'errorMessage' => $errorMessage
        ];
    }
}
