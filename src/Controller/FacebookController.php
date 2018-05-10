<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/fb")
 */
class FacebookController extends Controller
{
    /**
     * @Route("/hear", name="fb_hear")
     * @Template()
     */
    public function hear(Request $request)
    {
        \BotMan\BotMan\Drivers\DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

        $botman = \BotMan\BotMan\BotManFactory::create(['facebook' => [
            'token' => 'your-token-here',
            'app_secret' => 'your-secret-here',
            'verification'=> 'your-verification',
        ]]);

        $botman->hears('hello', function (\BotMan\BotMan\BotMan $bot) {
            $bot->reply('hello yourself.');
        });

        $botman->listen();

        return new Response();
    }
}
