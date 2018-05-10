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
 * @Route("/web")
 */
class WebController extends Controller
{
    /**
     * @Route("/hear", name="web_hear")
     * @Method({"POST"})
     * @Template()
     */
    public function hear(Request $request)
    {
        \BotMan\BotMan\Drivers\DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $botman = \BotMan\BotMan\BotManFactory::create([]);

        $botman->hears('hello', function (\BotMan\BotMan\BotMan $bot) {
            $bot->reply('hello yourself.');
        });

        $botman->listen();

        return new Response();
    }
}
