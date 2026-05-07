<?php

namespace App\Http\Middleware;

use Closure;
use BotMan\BotMan\BotMan;
use App\Conversations\PlantChatbotConversation;

class RegisterBotManConversations
{
    public function handle($request, Closure $next)
    {
        if ($request->path() === 'botman/chat') {
            $botman = app('botman');

            // Main conversation starter
            $botman->hears('.*', function (BotMan $bot) {
                $bot->startConversation(new PlantChatbotConversation());
            });
        }

        return $next($request);
    }
}
