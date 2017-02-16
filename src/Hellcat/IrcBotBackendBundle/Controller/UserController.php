<?php

namespace Hellcat\IrcBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class UserController
 * @package Hellcat\IrcBotBackendBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/dashboard", name="user_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
    }
}
