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
        $user = $this->get('hc_user.service.user');

        if( $request->get('login', '') == 'login' ) {
//            $response = new RedirectResponse($request->getRequestUri(), 302);
            $response = new RedirectResponse('/', 302);

            /** @var \Hellcat\Tools\UserBundle\Service\UserManagement\User $user */
            $r = $user->login('test', 'xxxxxxxx', 'REMEMBER', $request, $response);
            $request->getSession()->set('_loginStatus', $r->isSuccess());
            $request->getSession()->set('_loginMessage', $r->getMessage());


            return $response;
        }

        if( $request->get('login', '') == 'logout' ) {
            $response = new RedirectResponse('/user/dashboard', 302);
            $user->logout($request, $response);
            return $response;
        }

        if( $request->getSession()->get('_loginStatus', false) ) {
            $request->getSession()->remove('_loginStatus');
            $request->getSession()->remove('_loginMessage');
            return $this->redirect('/user/dashboard');
        }

        return [];
    }
}
