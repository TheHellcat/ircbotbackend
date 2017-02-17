<?php

namespace Hellcat\IrcBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class IndexController
 * @package Hellcat\IrcBotBackendBundle\Controller
 */
class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $loginMessage = '';

        $user = $this->get('hc_user.service.user');

        if( $request->get('login', '') == 'login' ) {
//            $response = new RedirectResponse($request->getRequestUri(), 302);
            $response = new RedirectResponse('/user/dashboard', 302);

            /** @var \Hellcat\Tools\UserBundle\Service\UserManagement\User $user */
            $r = $user->login('test', 'xxxxxxxx', 'REMEMBER', $request, $response);

            if ( $r->isSuccess() ) {
                return $response;
            }

            $loginMessage = $r->getMessage();
        }

        if( $request->get('login', '') == 'logout' ) {
            $response = new RedirectResponse('/user/dashboard', 302);
            $user->logout($request, $response);
            return $response;
        }

        return [
            'loginMessage' => $loginMessage
        ];
    }
}
