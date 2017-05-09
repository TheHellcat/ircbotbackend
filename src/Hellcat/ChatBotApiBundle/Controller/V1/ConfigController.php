<?php

namespace Hellcat\ChatBotApiBundle\Controller\V1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ConfigController
 * @package Hellcat\ChatBotApiBundle\Controller\v1
 */
class ConfigController extends Controller
{
    /**
     * @Route("/getmainconfig", name="botapi_v1_mainconfig")
     */
    public function mainConfigAction(Request $request)
    {
        $fuglyStaticResponseForDevelopmentPurposeOnly = '{
  "botNick": "hcgbot",
  "botUsername": "hcgbot",
  "botRealname": "Testus Bottus",
  "netHost": "irc.twitch.tv",
  "netPort": "6667",
  "netChannels": "#therealhellcat #hctest01 #lazy_idler",
  "netPassword": "oauth:fr7ymmn2azwgmh1hhe55lsxmbczqbc"
}
';
        $response = new JsonResponse();
        $response->setStatusCode(200)
            ->setContent($fuglyStaticResponseForDevelopmentPurposeOnly);

        return $response;
    }

    /**
     * @Route("/getchatcommands", name="botapi_v1_chatcmds")
     */
    public function chatCommandsAction()
    {
        $fuglyStaticResponseForDevelopmentPurposeOnly = '{"chatcommands":[
    {"command":"!uptime"},
    {"command":"!game"},
    {"command":"!test1"},
    {"command":"!test2"},
    {"command":"!test3"},
    {"command":"!test4"},
    {"command":"!test5"}],
"timedcommands":[
    {"command":"-timertest1", "timer":"30"},
    {"command":"-timertest2", "timer":"10"},
    {"command":"-timertest3", "timer":"60"}]}';

        $response = new JsonResponse();
        $response->setStatusCode(200)
            ->setContent($fuglyStaticResponseForDevelopmentPurposeOnly);

        return $response;
    }
}
