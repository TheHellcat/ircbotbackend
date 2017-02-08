<?php

namespace Hellcat\IrcBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    }

    /**
     * @Route("/dashboard", name="user_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
    }
}
