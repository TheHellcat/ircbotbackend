<?php

namespace Hellcat\IrcBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hellcat\IrcBotBackendBundle\Entity\System\User;

/**
 * Class TwitchAuthController
 * @package Hellcat\IrcBotBackendBundle\Controller
 */
class TwitchAuthController extends Controller
{
    /**
     * @Route("/login", name="twitch_auth")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $redirUrl = 'http://live.hellcat.net/twitch-manager/auth.php'; //$this->generateUrl('twitch_auth');
        $twitch = $this->get('hellcat_twitch_api');
        $entityManager = $this->get('hellcat_botbackend_entity_manager');
        $isError = false;

        if ($request->query->has('code')) {
            $twitchToken = $twitch->api()->auth()->fetchToken($request->query->get('code', ''), $redirUrl);
            $twitchUserData = $twitch->api()->auth()->getUserData($twitchToken->getAccessToken());

            $em = $entityManager->getDoctrineEntityManager();
            $user = $em->getRepository(User::class)->findOneBy(
                [
                    'twitchId' => $twitchUserData->getUserId()
                ]
            );

            if( null === $user ) {
                $user = $entityManager->system()->user();
                $user->setCreated((string)time());
            }

            $user->setTwitchId($twitchUserData->getUserId());
            $user->setDisplayName($twitchUserData->getDisplayName());
            $user->setChannel(strtolower($twitchUserData->getDisplayName()));
            $user->setOauthToken($twitchToken->getAccessToken());
            $user->setOauthRefreshToken($twitchToken->getRefreshToken());
            $user->setScope(serialize($twitchToken->getScope()));
            $user->setLastLogin((string)time());
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('user_dashboard'));
        } else if ($request->query->has('error')) {
            $isError = true;
            $errorMessage = $request->query->has('error_description');
        } else {
            return $this->redirect($twitch->api()->auth()->init($redirUrl));
        }

        return [
            'isError' => $isError,
            'errorMessage' => $errorMessage
        ];
    }
}
