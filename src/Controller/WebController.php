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
     * @Route("/", name="web_index")
     * @Method({"GET"})
     * @Template()
     */
    public function index() 
    {
        return [];
    }

    /**
     * @Route("/chat", name="web_chat")
     * @Method({"GET"})
     * @Template()
     */
    public function chat() 
    {
        return [];
    }

    /**
     * @Route("/hear", name="web_hear")
     * @Template()
     */
    public function hear(Request $request)
    {
        \BotMan\BotMan\Drivers\DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $botman = \BotMan\BotMan\BotManFactory::create([]);

        $botman->hears('hello', function (\BotMan\BotMan\BotMan $bot) {
            $bot->reply('hello yourself.');
        });

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand what you are saying');
        });
        
        $botman->listen();

        return new Response();
    }
}
