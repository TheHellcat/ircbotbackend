<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class AppController
 * @package AppBundle\Controller
 */
class AppController extends Controller
{
    /**
     * @Route("/", name="app_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('hc_user.service.user');
        $role = $this->get('hc_user.service.role');

        if ($request->get('login', '') == 'login') {
            $response = new RedirectResponse($request->getRequestUri(), 302);
//            $response = new RedirectResponse('/user/dashboard', 302);

            /** @var \Hellcat\Tools\UserBundle\Service\UserManagement\User $user */
            $r = $user->login('test', 'xxxxxxxx', 'REMEMBER', $request, $response);

            if ($r->isSuccess()) {
                dump('login OK');die;
                return $response;
            }

            $loginMessage = $r->getMessage();
        }

        return [];
    }

    /**
     * @Route("/login", name="app_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/botcfg/test", name="app_test")
     * @Template()
     */
    public function testAction(Request $request)
    {
        $twitch = $this->get('hellcat_twitch_api');

        $channels = $twitch->api()->channels();
        $users = $twitch->api()->users();

        $userData = $users->getUserByName($request->get('channel', ''));
        /** @var \Hellcat\TwitchApiBundle\Model\Twitch\Response\User\UserType $userData */
        $userData = $userData->getUsers()->first();

        dump('id: ' . $userData->getId());
        dump('bio: ' . $userData->getBio());
        dump('created: ' . $userData->getCreatedAt());

        $channelData = $channels->getChannelById($userData->getId());

        dump($channelData);

        dump('the end');die;
        return [];
    }

    /**
     * @Route("/logout", name="app_logout")
     * @Template()
     */
    public function logoutAction(Request $request)
    {
        return [];
    }
}
