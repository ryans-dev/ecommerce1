<?php

namespace App\Http\Middleware;

use Closure;
use BotMan\BotMan\BotMan;

class BotManMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->is('botman/chat')) {
            // Store the request for BotMan
            $this->setupBotMan();
        }

        return $next($request);
    }

    protected function setupBotMan()
    {
        $botman = app('botman');
        
        // Capture all messages
        $botman->hears('.*', function (BotMan $bot) {
            $bot->startConversation(new \App\Conversations\PlantChatbotConversation());
        });
    }
}
