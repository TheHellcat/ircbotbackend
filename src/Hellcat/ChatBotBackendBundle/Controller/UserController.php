<?php

namespace Hellcat\ChatBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hellcat\ChatBotBackendBundle\Entity\System\UserData;

/**
 * Class UserController
 * @package Hellcat\ChatBotBackendBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/dashboard", name="botbackend_user_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        return [];
    }
}
