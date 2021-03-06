<?php

namespace Hellcat\ChatBotBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GuzzleHttp\Client as HttpClient;

/**
 * Class IndexController
 * @package Hellcat\ChatBotBackendBundle\Controller
 */
class IndexController extends Controller
{
//    /**
//     * @Route("/chatbotapi/test", name="api_test2")
//     * @Template()
//     */
//    public function apitestAction()
//    {
//        echo "APITEST:OK";
//        die;
//    }
//
//    /**
//     * @Route("/user/test", name="api_test1")
//     * @Template()
//     */
//    public function twitchTestAction()
//    {
//        $twitch = $this->get('hellcat_twitch_api');
//        dump($twitch->api()->channels()->getChannel('0uaxs9rke04tbexldj7mc9yi6mskei'));
//    }

    /**
     * @Route("/", name="botbackend_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [];
//        $loginMessage = '';
//
//        $user = $this->get('hc_user.service.user');
//        $role = $this->get('hc_user.service.role');
//
//        if( $request->get('login', '') == 'api' ) {
//            $httpClient = new HttpClient();
//
//            $body = 'TEST TEST TEST';
//            $url = 'http://ircbotbackend.local/chatbotapi/test';
//            $periodLength = 90;
//            $timePeriod = (int)((time() - ($periodLength/2)) / $periodLength);
//            $hashStr = $url . $body . $timePeriod . 'TESTEST1';
//            $requestHash = hash('sha512', $hashStr);
//
//            $httpOptions = [
//                'body' => $body,
//                'headers' => [
//                    'access-key' => 'f72f366efcef11e6af69c38370dd29cbf7647194fcef11e6a947371c388b0752',
//                    'access-id' => 'apitest',
//                    'access-auth' => $requestHash
//                ]
//            ];
//
//            $r = $httpClient->post($url, $httpOptions);
//            $loginMessage = $r->getBody()->getContents();
//        }
//
//        if( $request->get('login', '') == 'add' ) {
//            $username = 'test_' . time();
//            $rolename = 'ROLE_TEST_' . time();
//            $user->register($username, '00000000');
//            $role->addRole($rolename, 'Test role at ' . time());
//            $role->assignRole($username, $rolename);
//        }
//
//        if( $request->get('login', '') == 'login' ) {
////            $response = new RedirectResponse($request->getRequestUri(), 302);
//            $response = new RedirectResponse('/user/dashboard', 302);
//
//            /** @var \Hellcat\Tools\UserBundle\Service\UserManagement\User $user */
//            $r = $user->login('test', 'xxxxxxxx', 'REMEMBER', $request, $response);
//
//            if ( $r->isSuccess() ) {
//                return $response;
//            }
//
//            $loginMessage = $r->getMessage();
//        }
//
//        if( $request->get('login', '') == 'logout' ) {
//            $response = new RedirectResponse('/user/dashboard', 302);
//            $response = $user->logout($request, $response);
//            return $response;
//        }
//
//        return [
//            'loginMessage' => $loginMessage
//        ];
    }
}
