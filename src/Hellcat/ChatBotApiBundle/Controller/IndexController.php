<?php

namespace Hellcat\ChatBotApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class IndexController
 * @package Hellcat\ChatBotApiBundle\Controller
 */
class IndexController extends Controller
{
    /**
     * @Route("/register/{apikey}", name="botapi_reg")
     * @Template()
     */
    public function botRegisterAction(Request $request, $apikey)
    {
        $username = 'apitest';
        $secret = 'TESTEST1';

        return [
            'username' => $username,
            'secret' => $secret
        ];
    }
}
