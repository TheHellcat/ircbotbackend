<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/logout", name="app_logout")
     * @Template()
     */
    public function logoutAction(Request $request)
    {
        return [];
    }
}
